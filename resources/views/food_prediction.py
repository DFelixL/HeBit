import pandas as pd
import numpy as np
import tensorflow as tf
from tensorflow.keras.preprocessing import image
from flask import Flask, request, jsonify
import gdown
import os

# URLs for downloading the files
model_url = 'https://drive.google.com/uc?id=1XwVsSCQ-U2z0CmFFWGXh7ccAx-5ifoUP'
csv_url = 'https://drive.google.com/uc?id=1tHxpD4zDaG0joxDoZoW_I-LS8UBVhzzq'

# Local paths where the files will be saved
model_path = 'food_recognition_inceptionV3.h5'
csv_path = 'food_calories.csv'

# Function to download the model and CSV files (consider adding error handling)
def download_files():
    if not os.path.exists(model_path):
        print("Downloading model...")
        gdown.download(model_url, model_path, quiet=False)
    if not os.path.exists(csv_path):
        print("Downloading CSV file...")
        gdown.download(csv_url, csv_path, quiet=False)

# Download files
download_files()

# Load the pre-trained model
model = tf.keras.models.load_model(model_path)

# Load the CSV file
calories_df = pd.read_csv(csv_path)

# Use the correct column names (assuming consistent column names)
calories_dict = dict(zip(calories_df['food_item'], calories_df['calories_per_100g']))

# List of classes (assuming the list remains constant)
classes = ['apple_pie', 'baby_back_ribs', 'baklava', ...]  # Add all class names here

# Define the prediction function (assuming it's used internally)
@tf.function
def predict(img_processed):
    return model(img_processed)

# Image preprocessing function
def preprocess_image(filename):
    img_ = image.load_img(filename, target_size=(228, 228))
    img_array = image.img_to_array(img_)
    img_processed = np.expand_dims(img_array, axis=0)
    img_processed = img_processed.astype('float32') / 255.
    return img_processed

# Function to get prediction and calories
def predict_image(filename, model, calories_dict):
    img_processed = preprocess_image(filename)
    prediction = predict(img_processed)
    index = np.argmax(prediction.numpy())
    pred = str(classes[index]).title()  # Prediction

    calories = calories_dict.get(pred.lower(), "Calories not found")

    return pred, calories

# Initialize Flask app
app = Flask(__name__)

@app.route('/predict', methods=['POST'])
def predict_api():
    data = request.json
    image_path = data.get('image_path')
    grams = data.get('grams')

    if not os.path.isfile(image_path):
        return jsonify({'error': 'Invalid file path. Please try again.'}), 400

    pred, calories = predict_image(image_path, model, calories_dict)
    if calories == "Calories not found":
        result = {'predicted_food': pred, 'calories': calories}
    else:
        result = {'predicted_food': pred, 'calories': calories / 100 * grams}

    return jsonify(result)

if __name__ == "__main__":
    app.run(debug=True)
