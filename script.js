function showAlert(message) {
    document.getElementById("alertModalBody").innerText = message;
    $('#alertModal').modal('show');
}

//Táblázatba beszúrás
document.getElementById("gradesForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    const formData = new FormData(this);
    fetch("insert.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        showAlert(data); 
        updateTable(); 
        this.reset(); 
    });
});

// Törlés funkció
let studentNameToDelete = '';

function deleteStudent(studentName) {
    studentNameToDelete = studentName; 
    document.getElementById("studentNameToDelete").innerText = studentName; 
    $('#deleteConfirmModal').modal('show'); 
}

// Eseménykezelő a törlés megerősítésére
document.getElementById("confirmDeleteButton").addEventListener("click", function() {
    const formData = new FormData();
    formData.append("student_name", studentNameToDelete);
    
    fetch("delete.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        showAlert(data); 
        updateTable(); 
        $('#deleteConfirmModal').modal('hide'); 
    });
});

// Szerkesztés funkció
function editStudent(studentName, grades) {
    document.getElementById("studentNameToEdit").value = studentName; 
    document.getElementById("newGrades").value = grades;
    $('#editModal').modal('show');
}

// Eseménykezelő a szerkesztés mentésére
document.getElementById("confirmEditButton").addEventListener("click", function() {
    const studentName = document.getElementById("studentNameToEdit").value;
    const newGrades = document.getElementById("newGrades").value;

    const formData = new FormData();
    formData.append("student_name", studentName);
    formData.append("grades", newGrades);

    fetch("edit.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        showAlert(data); 
        updateTable(); 
        $('#editModal').modal('hide');
    });
});

// Táblázat frissítése
function updateTable() {
    fetch("fetch_data.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("gradesTable").innerHTML = data;
        })
        .catch(error => console.error("Hiba a táblázat frissítésekor:", error));
}






