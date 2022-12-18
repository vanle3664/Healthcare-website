# from rasa_sdk import Action, Tracker
# from rasa_sdk.executor import CollectingDispatcher
# from typing import Any, Text, Dict, List
# from rasa_sdk.events import SlotSet

# import logging
# logger = logging.getLogger(__name__)
# logging.basicConfig(level='DEBUG')
# logger.info("LOG")

# class PredictAction(Action):

#     def name(self):
#         return "action_chan_doan"

#     def run(self, dispatcher: CollectingDispatcher, tracker: Tracker, domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:
#         print('zap', tracker.slots)
#         symptoms = tracker.slots.get('symptoms')
#         print(symptoms)
#         mess="Các triệu chứng của bạn là " + symptoms
#         dispatcher.utter_message(text=mess)
#         return []
from typing import Any, Text, Dict, List

from rasa_sdk.events import SlotSet
from rasa_sdk import Action, Tracker
from rasa_sdk.executor import CollectingDispatcher

import pandas as pd
import numpy as np
import joblib
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
        disease['VN'] = disease['VN'].str.lower()
        disease_dict = dict(zip(disease['EN'], disease['VN']))

        train_symptoms = list(symptoms['EN'])
        symptoms_enc = np.zeros(131)
        for s in symptoms_user:
            symptoms_enc[train_symptoms.index(symptoms_dict[s.lower()])] = 1
        symptoms_df = pd.DataFrame([symptoms_enc], columns=train_symptoms)

        loaded_model = load_model('predict_disease_model.h5')
        pred=loaded_model.predict(symptoms_df)


        top3 = pred[0].argsort()[-3:][::-1]

        disease_EN = list(disease['EN'])
        disease_EN.sort()

        ds_pred = [disease_dict[disease_EN[i]] for i in top3]
        pct_pred = [pred[0][i]*100 for i in top3]

        if not ds_pred:
            dispatcher.utter_message(text="Chưa chẩn đoán được.")
        else:
            dispatcher.utter_message(text=f"Bạn có thể bị {ds_pred} với khả năng {pct_pred}!")
        return []