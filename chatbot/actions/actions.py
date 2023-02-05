from typing import Any, Text, Dict, List

from rasa_sdk.events import SlotSet
from rasa_sdk import Action, Tracker
from rasa_sdk.executor import CollectingDispatcher

import pandas as pd
import numpy as np
import csv
from keras.models import load_model


class ActionDiseasePrediction(Action):

    def name(self) -> Text:
        return "action_chan_doan"

    def run(self, dispatcher: CollectingDispatcher,
            tracker: Tracker,
            domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:

        symptoms_user = tracker.get_slot("symptoms")
      
        symptoms = pd.read_csv('Symptoms.csv', header=None)
        symptoms.columns=['EN', 'VN']
        symptoms['VN'] = symptoms['VN'].str.lower()
        symptoms_dict = dict(zip(symptoms['VN'], symptoms['EN']))

        disease = pd.read_csv('Disease.csv', header=None)
        disease.columns=['EN', 'VN']
        disease['VN-hoa'] = disease['VN']
        disease['VN'] = disease['VN'].str.lower()
        disease_dict = dict(zip(disease['EN'], disease['VN-hoa']))

        train_symptoms = list(symptoms['EN'])
        symptoms_enc = np.zeros(131)
        for s in set(symptoms_user):
            symptoms_enc[train_symptoms.index(symptoms_dict[s.lower()])] = 1
        symptoms_df = pd.DataFrame([symptoms_enc], columns=train_symptoms)

        loaded_model = load_model('predict_disease_model.h5')
        pred=loaded_model.predict(symptoms_df)


        top3 = pred[0].argsort()[-3:][::-1]

        disease_EN = list(disease['EN'])
        disease_EN.sort()

        ds_pred = [disease_dict[disease_EN[i]] for i in top3]
        pct_pred = [pred[0][i]*100 for i in top3]

        pct_text = []
        for pct in pct_pred:
            pct_text.append("{:.2f}".format(round(pct, 2)))

        if not ds_pred:
            dispatcher.utter_message(text="Chưa chẩn đoán được.")
        else:
            dispatcher.utter_message(text=f"Doctorbot chẩn đoán bạn có thể mắc các bệnh: \n {ds_pred[0]} ({pct_text[0]}%)\n {ds_pred[1]} ({pct_text[1]}%) \n {ds_pred[2]} ({pct_text[2]}%)")
        return []

class ActionDrugForDisease(Action):

    def name(self) -> Text:
        return "action_dua_thuoc"

    def run(self, dispatcher: CollectingDispatcher,
            tracker: Tracker,
            domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:

        disease_user = tracker.get_slot("diseases")
        
        mapping_drug = {}
        with open('Drug.csv', mode='r', encoding="utf8") as infile:
            reader = csv.reader(infile)
            mapping_drug = {rows[1].lower():rows[2] for rows in reader}

        if ((disease_user not in mapping_drug.keys()) | (mapping_drug[disease_user] == 'N/A')):
            dispatcher.utter_message(text=f"Hiện tại Doctorbot chưa có dữ liệu về thuốc cho bệnh {disease_user}")
        else:
            dispatcher.utter_message(text=f"Các loại thuốc có thể dùng cho bệnh {disease_user}: {mapping_drug[disease_user]}")
        return []
        
