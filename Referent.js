    function limitSelections(checkbox) {
        var checkboxes = document.getElementsByName('checkbox_ref[]');
        var checkedCount = 0;

        for (var i = 0; i < checkboxes.length ; i++) {
            if (checkboxes[i].checked) {
                checkedCount++;
            }
        }

        if (checkedCount > 4) {
            checkbox.checked = false;
        }
    }

    function envoyerEmail() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send();
    }


    function validateForm() {
        // Récupérer tous les éléments checkbox
        var checkboxes = document.getElementsByName('checkbox_ref[]');
        
        // Vérifier si au moins une case est cochée
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                return true; // Au moins une case est cochée, permettre la soumission
            }
        }
        
        // Si aucune case n'est cochée, afficher un message d'erreur
        alert('Veuillez cocher au moins une case.');
        return false; // Empêcher la soumission du formulaire
    }