import random
import json
import os

def generate_random_person():
    first_names = [
        "John", "Jane", "Michael", "Emily", "David", "Sarah", "James", "Olivia", "Robert", "Sophia",
        "William", "Ava", "Joseph", "Mia", "Charles", "Charlotte", "Thomas", "Amelia", "Daniel", "Harper",
        "Matthew", "Ella", "Christopher", "Abigail", "Andrew", "Emily", "Joshua", "Elizabeth", "Henry",
        "Sofia", "Samuel", "Avery", "Ethan", "Evelyn", "Benjamin", "Chloe", "Nicholas", "Grace", "Jackson",
        "Victoria", "Logan", "Penelope", "Sebastian", "Lily", "Gabriel", "Hannah", "Nathan", "Liam"
    ]
    last_names = [
        "Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor",
        "Anderson", "Thomas", "Jackson", "White", "Harris", "Martin", "Thompson", "Garcia", "Martinez",
        "Robinson", "Clark", "Rodriguez", "Lewis", "Lee", "Walker", "Hall", "Allen", "Young", "Hernandez",
        "King", "Wright", "Lopez", "Hill", "Scott", "Green", "Adams", "Baker", "Gonzalez", "Nelson", "Carter",
        "Mitchell", "Perez", "Roberts", "Turner", "Phillips", "Campbell", "Parker", "Evans", "Edwards"
    ]
    avatars = [
        "https://randomuser.me/api/portraits/men/1.jpg",
        "https://randomuser.me/api/portraits/women/2.jpg",
        "https://randomuser.me/api/portraits/men/20.jpg",
        "https://randomuser.me/api/portraits/women/4.jpg",
        "https://randomuser.me/api/portraits/men/5.jpg",
        "https://randomuser.me/api/portraits/women/6.jpg",
        "https://randomuser.me/api/portraits/men/7.jpg",
        "https://randomuser.me/api/portraits/women/8.jpg",
        "https://randomuser.me/api/portraits/men/9.jpg",
        "https://randomuser.me/api/portraits/women/10.jpg"
    ]
    
    random_name = random.choice(first_names) + " " + random.choice(last_names)
    random_score = random.randint(500, 2000)
    random_niveau = random.randint(1, 5)
    random_avatar = random.choice(avatars)
    
    person = {
        "nom": random_name,
        "score": random_score,
        "niveau": random_niveau,
        "avatar": random_avatar
    }
    
    return person

# Obtention du chemin d'accès complet au fichier "data.json"
script_dir = os.path.dirname(os.path.abspath(__file__))
data_file_path = os.path.join(script_dir, 'data.json')

# Vérification de l'existence du fichier JSON
if os.path.isfile(data_file_path):
    # Chargement du fichier JSON existant
    with open(data_file_path) as json_file:
        data = json.load(json_file)
else:
    # Création d'un dictionnaire vide
    data = {"joueurs": []}

# Réinitialisation de la liste des joueurs
data["joueurs"] = []

# Génération de 100 nouvelles personnes
for _ in range(100):
    new_person = generate_random_person()
    data["joueurs"].append(new_person)

# Écriture des données mises à jour dans le fichier JSON
with open(data_file_path, 'w') as json_file:
    json.dump(data, json_file)
