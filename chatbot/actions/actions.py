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


class ActionNhacTrieuChung(Action):

    def name(self) -> Text:
        return "action_nhac_trieu_chung"

    def run(self, dispatcher: CollectingDispatcher,
            tracker: Tracker,
            domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:

        symptoms = tracker.get_slot("symptoms")
        if not symptoms:
            dispatcher.utter_message(text="I don't know your shirt size.")
        else:
            dispatcher.utter_message(text=f"Your shirt size is {symptoms}!")
        return []