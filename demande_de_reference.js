function limitSelections(checkbox) {
    var checkboxes = document.getElementsByName('checkbox[]');
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