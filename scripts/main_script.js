function openMenu() {
    const profileMenu = document.getElementById('menu');

    if(profileMenu.style.display == "block") {
        profileMenu.style.display = "none";
    } else {
        profileMenu.style.display = "block";
    }
}

window.onclick = function(event) {
    const profileMenu = document.getElementById('menu');
    
    if (!event.target.matches('.menu-btn')) {
        profileMenu.style.display = "none";
    }
}

function closeSidebar() {
    
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('close');
}


function openInsertForm() {
    
    const insertForm = document.getElementById('form-insert');
    insertForm.style.display = 'block';
}

function closeInsertForm() {

    const insertForm = document.getElementById('form-insert');
    insertForm.style.display = 'none';
}

function closeForm() {

    location.href = "?";
}

function openViewForm(id) {
    
    location.href = "?view_id=" + id;
}

function openEditForm(id) {
    
    location.href = "?edit_id=" + id;
}

function openDeleteForm(id) {
    
    location.href = "?delete_id=" + id;
}