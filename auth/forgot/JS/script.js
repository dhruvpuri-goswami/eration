class allToolsForgetPage {
    constructor(checkMailWrapSecId, otpVerfctWrapSecId, savePwdWrapSecId, emailLabelId, emailInptId, checkMailBtnId, emailErrMsgLabelID, otpResendBtnId, otpLabelId, otpInptId, otpVerifyBtnId, otpErrMsgLabelId, pwdLabelId, pwdInptId, pwdHideShowBtnId, pwdSaveBtnId, pwdErrMsgLabelID) {
        this.getMailWrapSection = document.getElementById(checkMailWrapSecId);
        this.getOtpWrapSection = document.getElementById(otpVerfctWrapSecId);
        this.getPwdSaveWrapSection = document.getElementById(savePwdWrapSecId);
        this.getEmailLabel = document.getElementById(emailLabelId);
        this.getEmailInpt = document.getElementById(emailInptId);
        this.getEmailCheckBtn = document.getElementById(checkMailBtnId);
        this.getEmailErrMsgLabel = document.getElementById(emailErrMsgLabelID);
        this.getOtpResendBtn = document.getElementById(otpResendBtnId);
        this.getOtpLabel = document.getElementById(otpLabelId);
        this.getOtpInpt = document.getElementById(otpInptId);
        this.getOtpVerifyBtn = document.getElementById(otpVerifyBtnId);
        this.getOtpErrMsgLabel = document.getElementById(otpErrMsgLabelId);
        this.getPwdLabel = document.getElementById(pwdLabelId);
        this.getPwdInpt = document.getElementById(pwdInptId);
        this.getPwdHideShowBtn = document.getElementById(pwdHideShowBtnId);
        this.getPwdSaveBtn = document.getElementById(pwdSaveBtnId);
        this.getPwdErrMsgLabel = document.getElementById(pwdErrMsgLabelID);
    }
}

class restPwdInfo {
    constructor(userEmail, userNewPwd) {
        this.userEmail = userEmail;
        this.userNewPwd = userNewPwd;
    }
}

let allToolsObj = new allToolsForgetPage("checkMailWrapSec", "otpVerfctWrapSec", "savePwdWrapSec", "emailLabel", "usrEmailInpt", "checkMailBtn", "emailErrMsgLbl", "resentOTPLabel", "mailOTPLabel", "emailOTPInpt", "verfyOtpBtn", "otpErrorMsgLabel", "pwdUserAccLabel", "pwdUserAccInpt", "hdShwRegPwdBtn", "savePwdBtn", "savePwdErrMsg");

allToolsObj.getEmailCheckBtn.addEventListener("click", async() => {
    console.log(allToolsObj.getEmailInpt.value);
    let isEmailExist = true;
    if (allToolsObj.getEmailInpt.value == "") {
        allToolsObj.getEmailErrMsgLabel.innerHTML = "Please, Enter your email!";
        allToolsObj.getEmailLabel.classList.add("focus-label");
    } else if (!new RegExp('^[A-Za-z0-9._]+@gmail.com').test(allToolsObj.getEmailInpt.value)) {
        allToolsObj.getEmailErrMsgLabel.innerHTML = "Please, Enter valid email!";
        allToolsObj.getEmailLabel.classList.add("focus-label");

        if (!allToolsObj.getOtpWrapSection.classList.contains("hide-opacity-wrapsec")) {
            allToolsObj.getOtpWrapSection.classList.add("hide-opacity-wrapsec");
        }
    } else if (new RegExp('^[A-Za-z0-9._]+@gmail.com').test(allToolsObj.getEmailInpt.value)) {
        allToolsObj.getEmailCheckBtn.innerHTML = "Sending...";
        isEmailExist = false;
        //api call for generating otp  
        await fetch("../../PHP/resetPassword.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'email': allToolsObj.getEmailInpt.value,
                'isVerification': 0,
            })
        }).then((response) => {
            return response.json();
        }).then((data) => {
            if (data.status == 200) {
                isEmailExist = true;
                allToolsObj.getEmailCheckBtn.innerHTML = "<i class='fa-solid fa-share'></i> Send";
            } else {
                allToolsObj.getEmailErrMsgLabel.innerHTML = data.msg;
                allToolsObj.getEmailCheckBtn.innerHTML = "<i class='fa-solid fa-share'></i> Send";
                setTimeout(() => {
                    allToolsObj.getEmailErrMsgLabel.innerHTML = '';
                }, 3000);
                return;
            }
        })



        let isOtpVerified = false;
        if (isEmailExist) {
            allToolsObj.getOtpWrapSection.classList.remove("hide-opacity-wrapsec");
            allToolsObj.getOtpVerifyBtn.addEventListener("click", async() => {
                if (allToolsObj.getOtpInpt.value == "") {
                    allToolsObj.getOtpLabel.classList.add("focus-label");
                    allToolsObj.getOtpErrMsgLabel.innerHTML = "Please, Enter your OTP to reset password!";
                } else {
                    const resetFeilds = (...e) => {
                        e.forEach(element => {
                            setTimeout(() => {
                                element.innerHTML = '';
                            }, 2000);
                        });
                    }

                    // for verification of otp
                    await fetch("../../PHP/resetPassword.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            'userOTP': allToolsObj.getOtpInpt.value,
                            'isVerification': 0,
                        })
                    }).then((response) => {
                        return response.json();
                    }).then((data) => {
                        if (data.status == 200) {
                            isOtpVerified= true;
                        } else {
                            allToolsObj.getOtpErrMsgLabel.innerHTML = data.msg;
                            resetFeilds(allToolsObj.getOtpErrMsgLabel);
                            return;
                        }
                    })

                    if (isOtpVerified) {

                        // hide mail wrapper and otp wrapper and show password reset wrapper
                        allToolsObj.getOtpWrapSection.classList.add("hide-opacity-wrapsec");
                        allToolsObj.getMailWrapSection.classList.add("hide-opacity-wrapsec");
                        allToolsObj.getPwdSaveWrapSection.classList.remove("hide-opacity-wrapsec");

                        // hide show password
                        allToolsObj.getPwdHideShowBtn.addEventListener("click", () => {
                            if (allToolsObj.getPwdInpt.getAttribute("type") == "text") {
                                allToolsObj.getPwdInpt.setAttribute("type", "password");
                                allToolsObj.getPwdHideShowBtn.classList = 'far fa-eye-slash';
                            } else {
                                allToolsObj.getPwdInpt.setAttribute("type", "text");
                                allToolsObj.getPwdHideShowBtn.classList = 'far fa-eye';
                            }
                        })

                            

                        allToolsObj.getPwdSaveBtn.addEventListener("click", async() => {
                            if (allToolsObj.getPwdInpt.value == "") {
                                allToolsObj.getPwdLabel.classList.add("focus-label");
                                allToolsObj.getPwdErrMsgLabel.innerHTML = "Please, Enter your New Password!";
                            } else {
                                // final result
                                let finalUserResetInfo = new restPwdInfo(allToolsObj.getEmailInpt.value, allToolsObj.getPwdInpt.value);
                                await fetch("../../PHP/resetPassword.php", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        'auth': finalUserResetInfo,
                                        'isVerification': 1,
                                    })
                                }).then((response) => {
                                    return response.json();
                                }).then((data) => {
                                    if (data.status == 200) {
                                        window.location.href = '../';
                                    } else {
                                        allToolsObj.getPwdErrMsgLabel.innerHTML = data.msg;
                                        resetFeilds(allToolsObj.getPwdErrMsgLabel);
                                        return;
                                    }
                                })
                                console.log(JSON.stringify({
                                    'auth': finalUserResetInfo,
                                    'isVerification': 1,
                                }));
                            }
                        })
                    }
                }
            })
        } else {
            allToolsObj.getEmailErrMsgLabel.innerHTML = "can't find any account with this email!";
        }
    }

    setTimeout(() => {
        allToolsObj.getEmailErrMsgLabel.innerHTML = "";
        allToolsObj.getEmailLabel.classList.remove("focus-label");
    }, 2000);
})
















// class allToolsForgetPage {
//     constructor(checkMailWrapSecId, otpVerfctWrapSecId, savePwdWrapSecId, emailLabelId, emailInptId, checkMailBtnId, emailErrMsgLabelID, otpResendBtnId, otpLabelId, otpInptId, otpVerifyBtnId, otpErrMsgLabelId, pwdLabelId, pwdInptId, pwdHideShowBtnId, pwdSaveBtnId, pwdErrMsgLabelID) {
//         this.getMailWrapSection = document.getElementById(checkMailWrapSecId);
//         this.getOtpWrapSection = document.getElementById(otpVerfctWrapSecId);
//         this.getPwdSaveWrapSection = document.getElementById(savePwdWrapSecId);
//         this.getEmailLabel = document.getElementById(emailLabelId);
//         this.getEmailInpt = document.getElementById(emailInptId);
//         this.getEmailCheckBtn = document.getElementById(checkMailBtnId);
//         this.getEmailErrMsgLabel = document.getElementById(emailErrMsgLabelID);
//         this.getOtpResendBtn = document.getElementById(otpResendBtnId);
//         this.getOtpLabel = document.getElementById(otpLabelId);
//         this.getOtpInpt = document.getElementById(otpInptId);
//         // this.getOtpVerifyBtn = document.getElementById(otpVerifyBtnId);
//         this.getOtpErrMsgLabel = document.getElementById(otpErrMsgLabelId);
//         this.getPwdLabel = document.getElementById(pwdLabelId);
//         this.getPwdInpt = document.getElementById(pwdInptId);
//         this.getPwdHideShowBtn = document.getElementById(pwdHideShowBtnId);
//         this.getPwdSaveBtn = document.getElementById(pwdSaveBtnId);
//         this.getPwdErrMsgLabel = document.getElementById(pwdErrMsgLabelID);
//     }
// }

// class restPwdInfo {
//     constructor(userEmail, userNewPwd) {
//         this.userEmail = userEmail;
//         this.userNewPwd = userNewPwd;
//     }
// }

// let allToolsObj = new allToolsForgetPage("checkMailWrapSec", "otpVerfctWrapSec", "savePwdWrapSec", "emailLabel", "usrEmailInpt", "checkMailBtn", "emailErrMsgLbl", "resentOTPLabel", "mailOTPLabel", "emailOTPInpt", "verfyOtpBtn", "otpErrorMsgLabel", "pwdUserAccLabel", "pwdUserAccInpt", "hdShwRegPwdBtn", "savePwdBtn", "savePwdErrMsg");

// allToolsObj.getEmailCheckBtn.addEventListener("click", async () => {
//     console.log(allToolsObj.getEmailInpt.value);
//     let isEmailExist = true;
//     if (allToolsObj.getEmailInpt.value == "") {
//         allToolsObj.getEmailErrMsgLabel.innerHTML = "Please, Enter your email!";
//         allToolsObj.getEmailLabel.classList.add("focus-label");
//     } else if (!new RegExp('^[A-Za-z0-9._]+@gmail.com').test(allToolsObj.getEmailInpt.value)) {
//         allToolsObj.getEmailErrMsgLabel.innerHTML = "Please, Enter valid email!";
//         allToolsObj.getEmailLabel.classList.add("focus-label");

//         if (!allToolsObj.getOtpWrapSection.classList.contains("hide-opacity-wrapsec")) {
//             allToolsObj.getOtpWrapSection.classList.add("hide-opacity-wrapsec");
//         }
//     } else if (new RegExp('^[A-Za-z0-9._]+@gmail.com').test(allToolsObj.getEmailInpt.value)) {

//         allToolsObj.getEmailCheckBtn.innerHTML = "Sending...";
//         //api call for generating otp
//         isEmailExist = false;
//         await fetch("../../PHP/resetPassword.php", {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({
//                 'email': allToolsObj.getEmailInpt.value,
//                 'isVerification': 0,
//             })
//         }).then((response) => {
//             return response.json();
//         }).then((data) => {
//             console.log(data)
//             if (data.status == 200) {
//                 isEmailExist = true;
//                 allToolsObj.getEmailCheckBtn.innerHTML = "<i class='fa-solid fa-share'></i> Send";
//             } else {
//                 allToolsObj.getEmailErrMsgLabel.innerHTML = data.msg;
//                 allToolsObj.getEmailCheckBtn.innerHTML = "<i class='fa-solid fa-share'></i> Send";
//                 setTimeout(() => {
//                     allToolsObj.getEmailErrMsgLabel.innerHTML = '';
//                 }, 3000);
//                 return;
//             }
//         })

//         let isOtpVerified = false;
//         if (isEmailExist) {
//             allToolsObj.getOtpWrapSection.classList.remove("hide-opacity-wrapsec");
//             allToolsObj.getPwdSaveWrapSection.classList.remove("hide-opacity-wrapsec");
//             allToolsObj.getPwdSaveBtn.addEventListener("click", async () => {
//                 console.log('clicked')
//                 if (allToolsObj.getOtpInpt.value == "" && allToolsObj.getPwdInpt.value == "") {
//                     allToolsObj.getOtpLabel.classList.add("focus-label");
//                     allToolsObj.getPwdLabel.classList.add("focus-label");
//                     allToolsObj.getPwdErrMsgLabel.innerHTML = "Please, Enter your fields to reset password";
//                     resetFeilds(allToolsObj.getOtpLabel, allToolsObj.getPwdLabel);
//                 } else if (allToolsObj.getOtpInpt.value == "") {
//                     allToolsObj.getOtpLabel.classList.add("focus-label");
//                     allToolsObj.getPwdErrMsgLabel.innerHTML = "Please, Enter your OTP to reset password";
//                     resetFeilds(allToolsObj.getOtpLabel);
//                 } else if (allToolsObj.getPwdInpt.value == "") {
//                     allToolsObj.getPwdLabel.classList.add("focus-label");
//                     allToolsObj.getPwdErrMsgLabel.innerHTML = "Please, Enter your New Password!";
//                     resetFeilds(allToolsObj.getPwdLabel);
//                 } else {


//                     //for verification of otp
//                     await fetch("../../PHP/resetPassword.php", {
//                         method: 'POST',
//                         headers: {
//                             'Content-Type': 'application/json'
//                         },
//                         body: JSON.stringify({
//                             "auth": {
//                                 'userOTP': allToolsObj.getOtpInpt.value,
//                                 'newPass': allToolsObj.getPwdInpt.value,
//                                 'email': allToolsObj.getEmailInpt.value,
//                                 'isVerification': 1,
//                             }
//                         })
//                     }).then((response) => {
//                         return response.json();
//                     }).then((data) => {
//                         console.log(data)
//                         if (data.status == 200) {
//                             // console.log("successfull");
//                             window.location.href = '../';
//                         } else {
//                             allToolsObj.getPwdErrMsgLabel.innerHTML = data.msg;
//                             resetFeilds(allToolsObj.getPwdErrMsgLabel);
//                             return;
//                         }
//                     })

//                     // allToolsObj.getPwdSaveBtn.addEventListener("click", () => {
//                     //     if (allToolsObj.getPwdInpt.value == "") {
//                     //         allToolsObj.getPwdLabel.classList.add("focus-label");
//                     //         allToolsObj.getPwdErrMsgLabel.innerHTML = "Please, Enter your New Password!";
//                     //     } else {
//                     //         // final result
//                     //         let finalUserResetInfo = new restPwdInfo(allToolsObj.getEmailInpt.value, allToolsObj.getPwdInpt.value);
//                     //         console.log(finalUserResetInfo);
//                     //     }
//                     // })
//                 }
//             })

//             //to undo the labels' highlighting
//             const resetFeilds = (...e) => {
//                 e.forEach(element => {
//                     setTimeout(() => {
//                         allToolsObj.getPwdErrMsgLabel.innerHTML = '';
//                         element.classList.remove("focus-label");
//                     }, 2000);
//                 });
//             }

//             // hide show password
//             allToolsObj.getPwdHideShowBtn.addEventListener("click", () => {
//                 if (allToolsObj.getPwdInpt.getAttribute("type") == "text") {
//                     allToolsObj.getPwdInpt.setAttribute("type", "password");
//                     allToolsObj.getPwdHideShowBtn.classList = 'far fa-eye-slash';
//                 } else {
//                     allToolsObj.getPwdInpt.setAttribute("type", "text");
//                     allToolsObj.getPwdHideShowBtn.classList = 'far fa-eye';
//                 }
//             })
//         }
//     }
//     setTimeout(() => {
//         allToolsObj.getEmailErrMsgLabel.innerHTML = "";
//         allToolsObj.getEmailLabel.classList.remove("focus-label");
//     }, 2000);
// })