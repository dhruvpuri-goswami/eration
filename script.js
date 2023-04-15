let userNameInpt = document.getElementById("userNameInpt");
let userEmailInpt = document.getElementById("userEmailInpt");
let userSubjectInpt = document.getElementById("userSubjectInpt");
let userMsgInpt = document.getElementById("userMsgInpt");
let userErrorMsgLabel = document.getElementById("errorGetInTouchLabel");
document.getElementById("submitGetInTouchForm").addEventListener("click", ()=>{
    if(userEmailInpt.value == "" || userNameInpt.value == "" || userSubjectInpt.value == "" || userMsgInpt.value == ""){
        userErrorMsgLabel.innerHTML = "Please, Fill All required field!";
    }
})