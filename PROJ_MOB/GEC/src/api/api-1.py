from fastapi import FastAPI, HTTPException, status
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel, EmailStr
from typing import List, Optional

app = FastAPI(
    title="API de Gestion Administrative Universitaire",
    description="API complète pour la gestion des étudiants, des classes et des affectations.",
    version="1.0.0"
)

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # En production, remplacez par l'URL exacte du Frontend
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

#MODÈLES DE DONNÉES

class Student(BaseModel):
    id: int
    nom: str
    prenom: str
    email: EmailStr
    classe_id: Optional[int] = None

class StudentUpdate(BaseModel):
    nom: Optional[str] = None
    prenom: Optional[str] = None
    email: Optional[EmailStr] = None

class Classe(BaseModel):
    id: int
    nom_classe: str

class ClasseUpdate(BaseModel):
    nom_classe: str

db_students: List[Student] = []
db_classes: List[Classe] = []

#GESTION DES ÉTUDIANTS

@app.get("/api/students", response_model=List[Student], tags=["Étudiants"])
def get_all_students():
    """Consulter la liste de tous les étudiants."""
    return db_students

@app.get("/api/students/{student_id}", response_model=Student, tags=["Étudiants"])
def get_student(student_id: int):
    """Rechercher et consulter un étudiant par son ID."""
    for student in db_students:
        if student.id == student_id:
            return student
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.post("/api/students", response_model=Student, status_code=status.HTTP_201_CREATED, tags=["Étudiants"])
def add_student(student: Student):
    """Ajouter un nouvel étudiant."""
    if any(s.id == student.id for s in db_students):
        raise HTTPException(status_code=400, detail="Un étudiant avec cet ID existe déjà.")
    db_students.append(student)
    return student

@app.put("/api/students/{student_id}", response_model=Student, tags=["Étudiants"])
def update_student(student_id: int, updated_data: StudentUpdate):
    """Modifier les informations d'un étudiant."""
    for student in db_students:
        if student.id == student_id:
            if updated_data.nom is not None: student.nom = updated_data.nom
            if updated_data.prenom is not None: student.prenom = updated_data.prenom
            if updated_data.email is not None: student.email = updated_data.email
            return student
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.delete("/api/students/{student_id}", tags=["Étudiants"])
def delete_student(student_id: int):
    """Supprimer un étudiant."""
    global db_students
    if not any(s.id == student_id for s in db_students):
        raise HTTPException(status_code=404, detail="Étudiant non trouvé.")
    db_students = [s for s in db_students if s.id != student_id]
    return {"message": f"L'étudiant {student_id} a été supprimé avec succès."}

#GESTION DES CLASSES

@app.get("/api/classes", response_model=List[Classe], tags=["Classes"])
def get_all_classes():
    """Consulter la liste des classes existantes."""
    return db_classes

@app.post("/api/classes", response_model=Classe, status_code=status.HTTP_201_CREATED, tags=["Classes"])
def add_classe(classe: Classe):
    """Ajouter une nouvelle classe."""
    if any(c.id == classe.id for c in db_classes):
        raise HTTPException(status_code=400, detail="Une classe avec cet ID existe déjà.")
    db_classes.append(classe)
    return classe

@app.put("/api/classes/{classe_id}", response_model=Classe, tags=["Classes"])
def update_classe(classe_id: int, updated_data: ClasseUpdate):
    """Modifier le nom d'une classe."""
    for classe in db_classes:
        if classe.id == classe_id:
            classe.nom_classe = updated_data.nom_classe
            return classe
    raise HTTPException(status_code=404, detail="Classe non trouvée.")

@app.delete("/api/classes/{classe_id}", tags=["Classes"])
def delete_classe(classe_id: int):
    """Supprimer une classe."""
    global db_classes
    if not any(c.id == classe_id for c in db_classes):
        raise HTTPException(status_code=404, detail="Classe non trouvée.")
    
    for student in db_students:
        if student.classe_id == classe_id:
            student.classe_id = None

    db_classes = [c for c in db_classes if c.id != classe_id]
    return {"message": f"La classe {classe_id} a été supprimée avec succès."}


#GESTION DES AFFECTATIONS

@app.post("/api/classes/{classe_id}/students/{student_id}", tags=["Affectations"])
def assign_student_to_classe(classe_id: int, student_id: int):
    """Associer un étudiant à une classe."""
    # Vérifier si la classe existe
    if not any(c.id == classe_id for c in db_classes):
        raise HTTPException(status_code=404, detail="Classe non trouvée.")
    
    # Trouver l'étudiant et lui assigner la classe
    for student in db_students:
        if student.id == student_id:
            student.classe_id = classe_id
            return {"message": f"L'étudiant {student_id} a été affecté à la classe {classe_id}."}
            
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.delete("/api/classes/{classe_id}/students/{student_id}", tags=["Affectations"])
def remove_student_from_classe(classe_id: int, student_id: int):
    """Retirer un étudiant d'une classe."""
    for student in db_students:
        if student.id == student_id:
            if student.classe_id == classe_id:
                student.classe_id = None
                return {"message": f"L'étudiant {student_id} a été retiré de la classe {classe_id}."}
            else:
                raise HTTPException(status_code=400, detail="L'étudiant n'est pas inscrit dans cette classe.")
                
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.get("/api/classes/{classe_id}/students", response_model=List[Student], tags=["Affectations"])
def get_students_from_classe(classe_id: int):
    """Consulter la liste des étudiants d'une classe spécifique."""
    if not any(c.id == classe_id for c in db_classes):
        raise HTTPException(status_code=404, detail="Classe non trouvée.")
        
    students_in_classe = [s for s in db_students if s.classe_id == classe_id]
    return students_in_classe