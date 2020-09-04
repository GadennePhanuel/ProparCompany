/*
* Ce code permet d'avoir plusieurs boites modales dans la même page Html si on le souhaite
*/






let modal = null   //permet de savoir quel boite modal est actuellement ouverte
const focusableSelector = "button, a, input, textarea"  //on déclare une variable qui nous aidera à sélectionner tous les éléments focusable au sein de notre boite modale
let focusables = []   //création d'un tableau les contenants et qui pourra changer (d'où l'utilisation d'un let içi)
let previouslyFocusedElement = null   //servira a conserver le pointage sur le lien d'ouverture de la boite modale sélectionnée


//FONCIONS
//ouverture boite modale
const openModal = async function (e) {        //on precise async pour le coté AJAX
    e.preventDefault()
    const target = e.target.getAttribute('href')
    if (target.startsWith('#')){             //cas normal pur HTML
        modal = document.querySelector(target)       //on sélectionne la cible (donc le lien) et on récupère son href (qui pointe vers la div contenant le code html (initialement en display none) qui sera le contenu de la boite)
    }else {                                 //cas AJAX
        modal = await loadModal(target)    //cette fonction (défini plus bas) devra me renvoyer l'élément HTML sur lequel je pourrais travailler
    }

    focusables = Array.from(modal.querySelectorAll(focusableSelector))    //je crée mon tableau d'éléments focusable en lien avec ma boite modal ouverte  (Array.from() me permet de récupérer une liste d'éléments, sans ça je récupére tous les Nodes)
    previouslyFocusedElement = document.querySelector(':focus')   //comme ça je sauvegarde dans mon élément le premier focus de fait (lors du click sur 'ouvrir boite modale')
    focusables[0].focus()   //on focus par défaut le premier éléments focusable dés l'ouverture de la boite modale
    modal.style.display = null          //on rend la boite visible
    modal.removeAttribute('aria-hidden')            //(par défaut) L'élément est exposé à l'API d'accessibilité.
    modal.setAttribute('aria-modal', 'true')  //Indique si un élément est modal lorsqu'il est affiché
    modal.addEventListener('click', closeModal)
    modal.querySelector('.js-modal-close').addEventListener('click', closeModal)
    modal.querySelector('.js-modal-stop').addEventListener('click', stopPropagation)
}

//fermeture de la boite
const closeModal = function (e){
    if (modal === null) return
    if (previouslyFocusedElement !== null) previouslyFocusedElement.focus()   //Permet qu'une fois la boite modale fermée, de faire revenir le focus sur le lien d'ouverture
    e.preventDefault()
    window.setTimeout(function (){         //ici j'impose un délai de 500ms avant la disparition de la fenetre modale afin de pouvoir faire des animations de fermeture dans le css
        modal.style.display = "none"
        modal = null
    }, 500)
    modal.setAttribute('aria-hidden', 'true')
    modal.removeAttribute('aria-modal')
    modal.removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-close').removeEventListener('click', closeModal)
    modal.querySelector('.js-modal-stop').removeEventListener('click', stopPropagation)
}

const stopPropagation = function (e){
    e.stopPropagation()
}
//fonction pour gérer la tabulation pour passer d'un élément focusable à un autre au sein même de notre boite modale (ACCESSIBILITE)
const focusInModal = function (e){
    e.preventDefault()
    let index = focusables.findIndex(f => f === modal.querySelector(':focus'))    //je récupère l'index de l'élément actuellement focus
    if (e.shiftKey === true){
        index--
    }else{
        index++
    }
    if (index >= focusables.length){
        index = 0
    }
    if (index < 0){
        index = focusables.length - 1
    }
    focusables[index].focus()
}

const loadModal = async function (url){
    // à faire en plus si on veux : afficher un loader
    const target = '#' + url.split('#')[1]
    const existingModal = document.querySelector(target)
    if(existingModal !== null) return existingModal
    const html = await fetch(url).then(response => response.text())
    const element = document.createRange().createContextualFragment(html).querySelector(target)
    if (element === null) throw `L'élément ${target} n'a pas été trouvé dans la page ${url}`
    document.body.append((element))
    return element
}












//EVENEMENTS
//on sélectionne tous les boutons ou liens qui sont destiné à ouvrir une boite modale et on lui applique la fonction openModal()
document.querySelectorAll('.js-modal').forEach(a => {
    a.addEventListener('click', openModal)
})


//gérer l'accessibilité
window.addEventListener('keydown', function (e){
    if (e.key === 'Escape' || e.key === 'Esc'){
        closeModal(e)
    }
    if (e.key === 'Tab' && modal !== null){
        focusInModal(e)
    }
})

