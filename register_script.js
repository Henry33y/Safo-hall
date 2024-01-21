const scholarshipContainer = document.querySelector('.choose_scholarship_container');
const notUnderScholarshipRadio = document.querySelector('#not_under_scholarship')
const underScholarshipRadio = document.querySelector('#under_scholarship')
const scholarshipSelect = document.querySelector('#scholarship_select')
const specifyScholarship = document.querySelector('#specify_scholarship_container')

underScholarshipRadio.addEventListener('change',showSpecifyScholarshipContainer)
notUnderScholarshipRadio.addEventListener('change',hideSpecifyScholarshipContainer)
function showSpecifyScholarshipContainer(){
    scholarshipContainer.style.display = 'inline-block'
}
function hideSpecifyScholarshipContainer(){
    scholarshipContainer.style.display = 'none'
}
function setDisplayToNone(element){
    element.style.display = 'none'
}
function showElement(element){
    element.style.display = 'block'
}
function handleSpecifyScholarship(){
    if(scholarshipSelect.value == 'others'){
        showElement(specifyScholarship)
    }
    else{
        setDisplayToNone(specifyScholarship)
    }
}

scholarshipSelect.addEventListener('change',handleSpecifyScholarship)
console.log('😅');