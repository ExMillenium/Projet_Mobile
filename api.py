from fastapi import FastAPI, HTTPException, status
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel, EmailStr
from typing import List, Optional

app = FastAPI(
    title="API de Gestion Administrative Universitaire",
    description="API complète pour la gestion des étudiants, des classes et des affectations.",
    version="1.0.0"
)

# --- CONFIGURATION DU CORS ---
# Permet à l'application React de Louis-Gilles de communiquer avec l'API sans blocage
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # En production, remplacez par l'URL exacte du Frontend
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# --- MODÈLES DE DONNÉES (SCHEMAS PYDANTIC) ---

class Student(BaseModel):
    INE: str
    Fname: str
    Lname: str
    Gender: str
    email: EmailStr
    PhoneNumber: str

class StudentUpdate(BaseModel):
    Fname: Optional[str] = None
    Lname: Optional[str] = None
    email: Optional[EmailStr] = None
    PhoneNumber: Optional[str] = None

class Classe(BaseModel):
    idClass: str
    ClassName: str

class ClasseUpdate(BaseModel):
    ClassName: str


# --- DATA SIMULÉE (Base de données temporaire) ---
db_students: List[Student] = []
db_classes: List[Classe] = []


# --- GESTION DES ÉTUDIANTS ---

@app.get("/api/students", response_model=List[Student], tags=["Étudiants"])
def get_all_students():
    """Consulter la liste de tous les étudiants."""
    return db_students

@app.get("/api/students/{student_id}", response_model=Student, tags=["Étudiants"])
def get_student(student_id: int):
    """Rechercher et consulter un étudiant par son ID."""
    for student in db_students:
        if student.INE == student_id:
            return student
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.post("/api/students", response_model=Student, status_code=status.HTTP_201_CREATED, tags=["Étudiants"])
def add_student(student: Student):
    """Ajouter un nouvel étudiant."""
    if any(s.INE == student.INE for s in db_students):
        raise HTTPException(status_code=400, detail="Un étudiant avec cet INE existe déjà.")
    db_students.append(student)
    return student

@app.put("/api/students/{student_id}", response_model=Student, tags=["Étudiants"])
def update_student(student_id: int, updated_data: StudentUpdate):
    """Modifier les informations d'un étudiant."""
    for student in db_students:
        if student.INE == student_id:
            if updated_data.Fname is not None: student.Fname = updated_data.Fname
            if updated_data.Lname is not None: student.Lname = updated_data.Lname
            if updated_data.email is not None: student.email = updated_data.email
            if updated_data.PhoneNumber is not None: student.PhoneNumber = updated_data.PhoneNumber
            return student
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.delete("/api/students/{student_id}", tags=["Étudiants"])
def delete_student(student_id: int):
    """Supprimer un étudiant."""
    global db_students
    if not any(s.INE == student_id for s in db_students):
        raise HTTPException(status_code=404, detail="Étudiant non trouvé.")
    db_students = [s for s in db_students if s.INE != student_id]
    return {"message": f"L'étudiant {student_id} a été supprimé avec succès."}


# --- 3. GESTION DES CLASSES ---

@app.get("/api/classes", response_model=List[Classe], tags=["Classes"])
def get_all_classes():
    """Consulter la liste des classes existantes."""
    return db_classes

@app.post("/api/classes", response_model=Classe, status_code=status.HTTP_201_CREATED, tags=["Classes"])
def add_classe(classe: Classe):
    """Ajouter une nouvelle classe."""
    if any(c.idClass == classe.idClass for c in db_classes):
        raise HTTPException(status_code=400, detail="Une classe avec cet ID existe déjà.")
    db_classes.append(classe)
    return classe

@app.put("/api/classes/{classe_id}", response_model=Classe, tags=["Classes"])
def update_classe(classe_id: str, updated_data: ClasseUpdate):
    """Modifier le nom d'une classe."""
    for classe in db_classes:
        if classe.idClass == classe_id:
            classe.ClassName = updated_data.ClassName
            return classe
    raise HTTPException(status_code=404, detail="Classe non trouvée.")

@app.delete("/api/classes/{classe_id}", tags=["Classes"])
def delete_classe(classe_id: str):
    """Supprimer une classe."""
    global db_classes
    if not any(c.idClass == classe_id for c in db_classes):
        raise HTTPException(status_code=404, detail="Classe non trouvée.")
    
    # Sécurité supplémentaire : désaffecter les étudiants de cette classe avant suppression
    for student in db_students:
        if student.classe_id == classe_id:
            student.classe_id = None

    db_classes = [c for c in db_classes if c.idClass != classe_id]
    return {"message": f"La classe {classe_id} a été supprimée avec succès."}


# --- 4. GESTION DES AFFECTATIONS ---

@app.post("/api/classes/{classe_id}/students/{student_id}", tags=["Affectations"])
def assign_student_to_classe(classe_id: str, student_id: str):
    """Associer un étudiant à une classe."""
    # Vérifier si la classe existe
    if not any(c.idClass == classe_id for c in db_classes):
        raise HTTPException(status_code=404, detail="Classe non trouvée.")
    
    # Trouver l'étudiant et lui assigner la classe
    for student in db_students:
        if student.INE == student_id:
            student.classe_id = classe_id
            return {"message": f"L'étudiant {student_id} a été affecté à la classe {classe_id}."}
            
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.delete("/api/classes/{classe_id}/students/{student_id}", tags=["Affectations"])
def remove_student_from_classe(classe_id: str, student_id: str):
    """Retirer un étudiant d'une classe."""
    for student in db_students:
        if student.INE == student_id:
            if student.classe_id == classe_id:
                student.classe_id = None
                return {"message": f"L'étudiant {student_id} a été retiré de la classe {classe_id}."}
            else:
                raise HTTPException(status_code=400, detail="L'étudiant n'est pas inscrit dans cette classe.")
                
    raise HTTPException(status_code=404, detail="Étudiant non trouvé.")

@app.get("/api/classes/{classe_id}/students", response_model=List[Student], tags=["Affectations"])
def get_students_from_classe(classe_id: str):
    """Consulter la liste des étudiants d'une classe spécifique."""
    if not any(c.idClass == classe_id for c in db_classes):
        raise HTTPException(status_code=404, detail="Classe non trouvée.")
        
    students_in_classe = [s for s in db_students if s.classe_id == classe_id]
    return students_in_classe