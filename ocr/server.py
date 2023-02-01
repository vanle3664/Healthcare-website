from fastapi import FastAPI, File, UploadFile, Response
from paddleocr import PaddleOCR  
from tensorflow.keras.utils import img_to_array
from matplotlib import pyplot as plt 
import cv2 
import os 
import numpy as np
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

    ocr_model = PaddleOCR(lang='en')
    result = ocr_model.ocr(image, cls=True)
    print(result)

    final = []

    for res in result:
        for r in res:
            final.append(r[:][:][1])
    
    max_point = -1
    for i in range(0, len(final)):
        if final[i][1] > max_point:
            drug = final[i][0]
    data = drug.split(" ")[0]
    return Response(content=data, media_type="application/xml") 

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