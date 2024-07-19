function openTab(evt, tabName) {
    // Esconder todos os conteúdos de aba
    var tabcontent = document.getElementsByClassName("tabcontent form-group");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remover a classe "active" de todos os botões
    var tablinks = document.getElementsByClassName("tablinks btn btn-info");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Mostrar a aba atual e adicionar a classe "active" ao botão que a abriu
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Abrir a primeira aba por padrão
document.addEventListener("DOMContentLoaded", function() {
    document.getElementsByClassName("tablinks")[0].click();
});

function confirmDelete(id) {
    if (confirm("Realmente deseja excluir este dado?")) {
        window.location.href = "deletar.php?&id=" + id;
    }
}
