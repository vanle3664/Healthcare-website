from fastapi import FastAPI, File, UploadFile
from paddleocr import PaddleOCR  
from tensorflow.keras.utils import img_to_array
from matplotlib import pyplot as plt 
import cv2 
import os 
from io import BytesIO
from PIL import Image

app = FastAPI()

@app.post("/search-by-image")
async def predict_api(file: UploadFile = File(...)):
    extension = file.filename.split(".")[-1] in ("jpg", "jpeg", "png")
    if not extension:
        return "Image must be jpg or png format!"
    image = Image.open(BytesIO(await file.read()))
    image = img_to_array(image)
    saved_image = cv2.imwrite("saved_image.png", image)

    ocr_model = PaddleOCR(lang='en')
    result = ocr_model.ocr(saved_image, cls=True)

    print(result)

    final = []

    for res in result:
        for r in res:
            final.append(r[:][:][1])
    
    os.remove("saved_image.jpg")
    return final

@app.post("/test")
async def predict_api1():
    ocr_model = PaddleOCR(lang='en')
    result = ocr_model.ocr("drug_real1.png")
    final = []
    for res in result:
        for r in res:
            final.append(r[:][:][1])
    final.sort(key=lambda x: x[1], reverse=True)
    
    return final