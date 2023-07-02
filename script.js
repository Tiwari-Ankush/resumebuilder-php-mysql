function addNewWEField() {
    let weField = document.createElement('textarea');
    weField.classList.add('form-control');
    weField.classList.add('weField');
    weField.classList.add('mt-2');
    weField.setAttribute('placeholder', 'Enter here..');
    weField.setAttribute('rows', '4');
    let weAddButton = document.getElementById('weAddButton');
    weAddButton.parentNode.insertBefore(weField, weAddButton);
}

// function addNewSkField() {
//     let skField = document.createElement('textarea');
//     skField.classList.add('form-control');
//     skField.classList.add('skField');
//     skField.classList.add('mt-2');
//     skField.setAttribute('placeholder', 'Enter here..');
//     skField.setAttribute('rows', '4');
//     let skAddButton = document.getElementById('skAddButton');
//     skAddButton.parentNode.insertBefore(skField, skAddButton);
// }

// Function to add new Academic Qualification field
function addNewAQField() {
    let eqField = document.createElement('textarea');
    eqField.classList.add('form-control');
    eqField.classList.add('eqField');
    eqField.classList.add('mt-2');
    eqField.setAttribute('placeholder', 'Enter here..');
    eqField.setAttribute('rows', '4');
    let aqAddButton = document.getElementById('aqAddButton');
    aqAddButton.parentNode.insertBefore(eqField, aqAddButton);
}
// -------------------------
//-------------------------
// generating cv
// function to generate the CV
function generateCV() {
    let nameField = document.getElementById("nameField").value;
    let contactField = document.getElementById("contactField").value;
    let addressField = document.getElementById("addressField").value;
    let fbField = document.getElementById("fbField").value;
    let instaField = document.getElementById("instaField").value;
    let LinkedField = document.getElementById("LinkedField").value;
    let objectiveField = document.getElementById("objectiveField").value;

    // Add profile photo
    // let profilePhoto = document.getElementById("profilePhoto");
    // let profilePhotoUrl = "";
    // if (profilePhoto.files.length > 0) {
    //     profilePhotoUrl = URL.createObjectURL(profilePhoto.files[0]);
    // }
    // update the CV template with the form data
    document.getElementById("nameT1").innerHTML = nameField;
    document.getElementById("nameT2").innerHTML = nameField;
    document.getElementById("contactT").innerHTML = contactField;
    document.getElementById("addressT").innerHTML = addressField;
    document.getElementById("fbT").href = fbField;
    document.getElementById("instaT").href = instaField;
    document.getElementById("LinkedT").href = LinkedField;
    document.getElementById("objectiveT").innerHTML = objectiveField;

    // Add profile photo
    // Add profile photo
    function handleFileSelect(event) {
        let file = event.target.files[0];
        let reader = new FileReader();

        reader.onload = function () {
            document.getElementById('imgTemplate').src = reader.result;
        };

        reader.readAsDataURL(file);
    }

    // Attach event listener to the file input
    document.getElementById('imgField').addEventListener('change', handleFileSelect);

    // if (file) {
    //     reader.readAsDataURL(file);
    // }



    let wes = document.getElementsByClassName("weField");
    let str = "";
    for (let e of wes) {
        str = str + `<li> ${e.value} </li>`;
    }
    document.getElementById("weT").innerHTML = str;

    // let sks = document.getElementsByClassName("skField");
    // let str2 = "";
    // for (let e of sks) {
    //     str = str + `<li> ${e.value} </li>`;
    // }
    // document.getElementById("skT").innerHTML = str2;


    let aqs = document.getElementsByClassName("eqField");
    let str1 = ''
    for (let e of aqs) {
        str1 += `<li> ${e.value} </li>`;
    }
    document.getElementById("aqT").innerHTML = str1;



    // show the CV template and hide the form
    document.getElementById("cv-form").style.display = "none";
    document.getElementById("cv-template").style.display = "block";
    // }
}
    function printCV() {
        window.print();
    }