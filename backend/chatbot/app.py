# app.py
from flask import Flask, request, jsonify, render_template
import json
import spacy
import csv

app = Flask(__name__)

# Muat model spaCy
try:
    nlp = spacy.load("xx_ent_wiki_sm")
except Exception as e:
    print(f"Error loading spaCy model: {e}")

# Muat kebijakan
try:
    with open('library_policies.json', 'r') as f:
        policies = json.load(f)
except FileNotFoundError:
    policies = {}
    print("Error: library_policies.json file not found.")

# Fungsi untuk memuat sinonim dari CSV
def load_synonyms(csv_file):
    synonyms = {}
    try:
        with open(csv_file, mode='r') as infile:
            reader = csv.reader(infile)
            next(reader)  # Lewati header
            for rows in reader:
                key = rows[0]
                values = rows[1:]
                synonyms[key] = values
    except FileNotFoundError:
        print(f"Error: {csv_file} file not found.")
    return synonyms

# Muat sinonim
synonyms = load_synonyms('synonyms.csv')

# Fungsi untuk mendapatkan respons
def get_response(user_input):
    user_input = user_input.lower().split()
    print(f"Input Pengguna: {' '.join(user_input)}")  # Logging input pengguna

    for word in user_input:
        for key, values in synonyms.items():
            if word in values:
                print(f"Cocok: {word} -> {key}")  # Logging kecocokan
                # Kembalikan respons yang sesuai dari kebijakan
                return policies.get(key, "Informasi tidak tersedia")

    return "Maaf, saya tidak mengerti pertanyaan Anda."

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/chat', methods=['POST'])
def chat():
    user_input = request.json.get('message')
    if not user_input:
        return jsonify({"response": "Pesan tidak boleh kosong."}), 400

    response = get_response(user_input)
    return jsonify({"response": response})

if __name__ == '__main__':
    app.run(debug=True)
