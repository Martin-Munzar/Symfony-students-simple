const students = document.getElementById('students');

if (students) {
    students.addEventListener('click', e => {
    if (e.target.className === 'btn btn-danger delete-student') {
        if (confirm('Opravdu chcete smazat tohoto studenta?')) {
            const id = e.target.getAttribute('data-id');
    
            fetch(`/students/delete/${id}`, {
              method: 'DELETE'
            }).then(res => window.location.reload());
          }
        }
      });
    }