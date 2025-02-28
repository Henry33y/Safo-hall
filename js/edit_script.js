document.addEventListener('DOMContentLoaded', () => {
    const scholarshipContainer = document.querySelector('.choose_scholarship_container');
    const notUnderScholarshipRadio = document.querySelector('#not_under_scholarship')
    const underScholarshipRadio = document.querySelector('#under_scholarship')
    const scholarshipSelect = document.querySelector('#scholarship_select')
    const specifyScholarship = document.querySelector('#specify_scholarship_container')
    const specifyArea = document.querySelector('#specify_area_container')

    const specify_disability_container = document.querySelector('.specify_disability_container')
    const challengedDisabilityRadio = document.querySelector('#challenged')
    const notChallengedDisabilityRadio = document.querySelector('#not_challenged')

    const form = document.querySelector('#register_form')
    const roomButtons = document.querySelectorAll('.room-button')
    const modalSubmitRoomBtn = document.querySelector('.modal-submit-btn')
    const roomNumberInput = document.querySelector('#room_number')
    const roomNumberDisplay = document.querySelector('#room_num_display')

     // Perform actions based on the current state
     if (underScholarshipRadio && underScholarshipRadio.checked) {
        showSpecifyScholarshipContainer();
    } else if (notUnderScholarshipRadio && notUnderScholarshipRadio.checked) {
        hideSpecifyScholarshipContainer();
    }

    underScholarshipRadio.addEventListener('change', showSpecifyScholarshipContainer)
    notUnderScholarshipRadio.addEventListener('change', hideSpecifyScholarshipContainer)
    function showSpecifyScholarshipContainer() {
        scholarshipContainer.style.display = 'inline-block'
    }
    function hideSpecifyScholarshipContainer() {
        scholarshipContainer.style.display = 'none'
    }
    function setDisplayToNone(element) {
        element.style.display = 'none'
    }
    function showElement(element) {
        element.style.display = 'block'
    }
    function handleSpecifyScholarship() {
        if (scholarshipSelect.value == 'others') {
            showElement(specifyScholarship)
        }else if(scholarshipSelect.value == 'Church Of Pentecost'){
            showElement(specifyArea)
        }
        else {
            setDisplayToNone(specifyScholarship)
            document.getElementById('specified_scholarship').value = '';
            setDisplayToNone(specifyArea)
        }
    }
    handleSpecifyScholarship()
    scholarshipSelect.addEventListener('change', handleSpecifyScholarship)
    // Perform actions based on the current state
    if (challengedDisabilityRadio && challengedDisabilityRadio.checked) {
        showElement(specify_disability_container);
    } else if (notChallengedDisabilityRadio && notChallengedDisabilityRadio.checked) {
        setDisplayToNone(specify_disability_container);
    }

    challengedDisabilityRadio.addEventListener('change', () => { showElement(specify_disability_container) })
    notChallengedDisabilityRadio.addEventListener('change', () => { setDisplayToNone(specify_disability_container) })

    form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
            e.preventDefault()
            e.stopPropagation()
        }

        form.classList.add('was-validated')
    }, false)

    let selectedRoomNumber
    roomButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedRoomNumber = button.value
        })
    });

    modalSubmitRoomBtn.addEventListener('click', () => {
        roomNumberInput.value = selectedRoomNumber
        roomNumberDisplay.innerText = selectedRoomNumber

        console.log(roomNumberInput.value);
    })
})