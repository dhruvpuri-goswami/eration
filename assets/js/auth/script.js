//for openning forgot password page 
const openForgotPwdPage = () =>{
    window.location.href = "./FORGOT/";
}




// loginPageShowBtn regPageShowBtn
let loginPageSecWrap = document.getElementById("authLoginSecWrap");
let RegPageSecWrap = document.getElementById("authRegSecWrap");
document.getElementById("loginPageShowBtn").addEventListener("click", () => {
    RegPageSecWrap.classList.add("unshow-authreg-sec-wrap");
    loginPageSecWrap.classList.add("show-auth-sec-wrap");

    document.getElementById("abstractShap1Glass").style.opacity = "0.1";

    setTimeout(() => {
        document.getElementById("abstractShap1Glass").style.opacity = "1";
        document.getElementById("abstractLeftRight").innerHTML = `<linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">
                                                                    <stop id="stop1" stop-color="rgba(0, 112.063, 124.156, 1)" offset="0%"></stop>
                                                                    <stop id="stop2" stop-color="rgba(92.228, 246.729, 255, 0.86)" offset="100%"></stop>
                                                                </linearGradient>`
    }, 1000);
})

document.getElementById("regPageShowBtn").addEventListener("click", () => {
    RegPageSecWrap.classList = "";
    RegPageSecWrap.classList.add("authreg-sec-wrap");
    loginPageSecWrap.classList.remove("show-auth-sec-wrap");

    document.getElementById("abstractShap2Glass").style.opacity = "0.1";

    setTimeout(() => {
        document.getElementById("abstractShap2Glass").style.opacity = "1";
        document.getElementById("abstractLeftRight").innerHTML = `<linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">
                                                                    <stop id="stop1" stop-color="rgba(55, 7, 242, 1)" offset="0%"></stop>
                                                                    <stop id="stop2" stop-color="rgba(146, 118, 255, 0.56)" offset="100%"></stop>
                                                                </linearGradient>`
    }, 1000);
})

// Utility All Action Input, Button in one place
class allInpt {
    constructor(emailInptID, pwdInptId, errLabelID, emailLabelID, pwdLabelId, hideShowBtnId, loginBtnId, cookieCheckId, emailSecWrap, pwdSecWrapId) {
        this.getEmailTag = document.getElementById(emailInptID);
        this.getPwdTag = document.getElementById(pwdInptId);
        this.getErrLblTag = document.getElementById(errLabelID);
        this.getEmailLblTag = document.getElementById(emailLabelID);
        this.getPwdLblTag = document.getElementById(pwdLabelId);
        this.getHideShowBtn = document.getElementById(hideShowBtnId);
        this.getLoginBtn = document.getElementById(loginBtnId);
        this.getRembrBtn = document.getElementById(cookieCheckId);
        this.getEmailSecTag = document.getElementById(emailSecWrap);
        this.getPwdSecTag = document.getElementById(pwdSecWrapId);
    }
}

let utilityInptObj = new allInpt('usrEmailInptSignIn', 'usrPwdInptSignIn', 'errMsgLbl', 'emailLabel',
    'pwdLabel', 'hdShwSignInBtn', 'loginAccBtn', 'chkRmberUsrDt', 'emailSecWrap', 'pwdSecWrap');


// Hide Show Password:
let HideShowBtn = utilityInptObj.getHideShowBtn;
let passwordInpt = utilityInptObj.getPwdTag;
HideShowBtn.addEventListener("click", () => {
    if (passwordInpt.getAttribute("type") == "text") {
        passwordInpt.setAttribute("type", "password");
        HideShowBtn.classList = 'far fa-eye-slash';
    } else {
        passwordInpt.setAttribute("type", "text");
        HideShowBtn.classList = 'far fa-eye';
    }
})

class login {
    constructor(email, password, isManual) {
        this.email = email;
        this.password = password;
        this.isManual = isManual;
    }
}


let loginBtn = utilityInptObj.getLoginBtn;
loginBtn.addEventListener("click", () => {
    console.log(utilityInptObj.getEmailTag.value, utilityInptObj.getPwdTag.value)
    if (utilityInptObj.getEmailTag.value == "" && utilityInptObj.getPwdTag.value == "") {
        utilityInptObj.getErrLblTag.innerHTML = `Please, Fill all required fields.`;

        // focus label by red color
        utilityInptObj.getEmailLblTag.classList.add("focus-email-lbl");
        utilityInptObj.getPwdLblTag.classList.add("focus-pwd-lbl");

        // focus section wrapper by border
        utilityInptObj.getEmailSecTag.classList.add("focus-email-wrap");
        utilityInptObj.getPwdSecTag.classList.add("focus-pwd-wrap");
    } else if (utilityInptObj.getEmailTag.value == "") {
        utilityInptObj.getErrLblTag.innerHTML = `Please, Fill out your email.`;
        utilityInptObj.getEmailLblTag.classList.add("focus-email-lbl");
        utilityInptObj.getEmailSecTag.classList.add("focus-email-wrap");
    } else if (utilityInptObj.getPwdTag.value == "") {
        utilityInptObj.getErrLblTag.innerHTML = `Please, Fill out password.`;
        utilityInptObj.getPwdLblTag.classList.add("focus-pwd-lbl");
        utilityInptObj.getPwdSecTag.classList.add("focus-pwd-wrap");
    }
    else {
        let userLoginInfoObj = new login(utilityInptObj.getEmailTag.value, utilityInptObj.getPwdTag.value);
        console.log(userLoginInfoObj);

        fetch("../PHP/login.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(userLoginInfoObj)
        }).then((response) => {
            return response.text()
        }).then((data) => {
            if (data == 1) {
                window.location.href = "../Users/Tution/dashboard.html";
            }
            else if (data == 2) {
                utilityInptObj.getErrLblTag.innerHTML = `User not found ! Please register your self !`;
            }
            else if (data == 0) {
                utilityInptObj.getErrLblTag.innerHTML = `Password does not match !`;
            }
            else {
                console.log(data);
            }
        })
    }

    setTimeout(() => {
        resetClass();
    }, 3000);
})

function resetClass() {
    utilityInptObj.getErrLblTag.innerHTML = "";
    utilityInptObj.getEmailLblTag.classList.remove("focus-email-lbl");
    utilityInptObj.getPwdLblTag.classList.remove("focus-pwd-lbl");
    utilityInptObj.getEmailSecTag.classList.remove("focus-email-wrap");
    utilityInptObj.getPwdSecTag.classList.remove("focus-pwd-wrap");
}



// Registration Input
class verifyEmailInpt {
    constructor(verifyTrackIconId, verifyTrackLineId, newUserEmailLabelID, newUserEmailInptID, errLabelID, verifyEmailBtnID, newUserEmailIconId, sectionNewUserEmailWrapperId, sectionVerifyEmailWrapperId, actualValidUserEmailLabelId, sectionPwdAccountId, sectionLiveTtlDtlId) {
        this.getTrackVerifyIcon = document.getElementById(verifyTrackIconId);
        this.getTrackVerifyLine = document.getElementById(verifyTrackLineId);
        this.getNewUserEmailLblTag = document.getElementById(newUserEmailLabelID);
        this.getNewUserEmailInpt = document.getElementById(newUserEmailInptID);
        this.getErrLblTag = document.getElementById(errLabelID);
        this.getVerifyEmailBtn = document.getElementById(verifyEmailBtnID);
        this.getNewUserEmailIconTag = document.getElementById(newUserEmailIconId);
        this.getNewUserEmailSecWrapper = document.getElementById(sectionNewUserEmailWrapperId);
        this.getVerifyEmailWrapper = document.getElementById(sectionVerifyEmailWrapperId);
        this.getSpanOfValidUserEmailLabel = document.getElementById(actualValidUserEmailLabelId);
        this.getPwdSectionWrapper = document.getElementById(sectionPwdAccountId);
        this.getLiveTtlDtlSectWrap = document.getElementById(sectionLiveTtlDtlId);
    }
}

// Verification EMAIL OTP all input
class otpSectionInpt {
    constructor(verifyTrackIconId, verifyTrackLineId, otpEmailLabelId, otpEmailInptId, errLabelID, otpEmailIconId, pwdTrackIconId, otpValidateBtnId) {
        this.getTrackVerifyIcon = document.getElementById(verifyTrackIconId);
        this.getTrackVerifyLine = document.getElementById(verifyTrackLineId);
        this.getOtpEmailLabelTag = document.getElementById(otpEmailLabelId);
        this.getOtpEmailInpt = document.getElementById(otpEmailInptId);
        this.getErrLblTag = document.getElementById(errLabelID);
        this.getOtpEmailIconTag = document.getElementById(otpEmailIconId);
        this.getPwdTrackIcon = document.getElementById(pwdTrackIconId);
        this.getOtpValidateBtn = document.getElementById(otpValidateBtnId);
    }
}

// Password Section All input
class pwdSectionInpt {
    constructor(pwdTrackId, pwdTrackLineID, liveTrackId, pwdLabelID, cnfPwdLabelID, errLabelID, pwdUserInpt, confirmPwdUserInpt, pwdIconWrapId, confirmPwdIconWrapId, pwdHdShwIconId, pwdCnfHdShwIconId, savePwdBtnId) {
        this.getPwdTrackIcon = document.getElementById(pwdTrackId);
        this.getPwdTrackLine = document.getElementById(pwdTrackLineID);
        this.getLiveTrackIcon = document.getElementById(liveTrackId);
        this.getPwdLabelTag = document.getElementById(pwdLabelID);
        this.getCnfPwdLabelTag = document.getElementById(cnfPwdLabelID);
        this.getErrLblTag = document.getElementById(errLabelID);
        this.getPwdUserInpt = document.getElementById(pwdUserInpt);
        this.getConfirmPwdUserInpt = document.getElementById(confirmPwdUserInpt);
        this.getPwdIconWrap = document.getElementById(pwdIconWrapId);
        this.getPwdConfirmIconWrap = document.getElementById(confirmPwdIconWrapId);
        this.getPwdHdShBtn = document.getElementById(pwdHdShwIconId);
        this.getCnfPwdHdShwIconId = document.getElementById(pwdCnfHdShwIconId);
        this.getPwdStoreBtn = document.getElementById(savePwdBtnId);
    }
}

// live section all input
class liveDtlSectionInpt {
    constructor(ttnNameLabelId, ttlNameInptId, ttnNameIconId, ttnUrlLabelId, ttnUrlInptId, ttnUrlIconId, errLabelID, finalRegDtlBtnId) {
        this.getTtnNameLabel = document.getElementById(ttnNameLabelId);
        this.getTtnNameInpt = document.getElementById(ttlNameInptId);
        this.getTtnNameIcon = document.getElementById(ttnNameIconId);
        this.getTtnUrlLabel = document.getElementById(ttnUrlLabelId);
        this.getTtnUrlInpt = document.getElementById(ttnUrlInptId);
        this.getTtnUrlIcon = document.getElementById(ttnUrlIconId);
        this.getErrLblTag = document.getElementById(errLabelID);
        this.getfinalRegDtlBtn = document.getElementById(finalRegDtlBtnId);
    }

    //For generating password in google login
    stringGenerator(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@$%()#!';
        let result = '';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        return result;
    }

    //live info handle
    clickHandler(res) {
        if (objLivDtlSecInpt.getTtnNameInpt.value == "" && objLivDtlSecInpt.getTtnUrlInpt.value == "") {
            objLivDtlSecInpt.getErrLblTag.innerHTML = `Please, Fill all required field!`;
            objLivDtlSecInpt.getTtnNameLabel.classList.add("focus-ttlName-label");
            objLivDtlSecInpt.getTtnUrlLabel.classList.add("focus-ttlWeb-label");
        } else if (objLivDtlSecInpt.getTtnNameInpt.value == "") {
            objLivDtlSecInpt.getErrLblTag.innerHTML = `Please, Specify Your Tuition Name`;
            objLivDtlSecInpt.getTtnNameLabel.classList.add("focus-ttlName-label");
        } else if (objLivDtlSecInpt.getTtnUrlInpt.value == "") {
            objLivDtlSecInpt.getErrLblTag.innerHTML = `Please, Specify WebUrl Name`;
            objLivDtlSecInpt.getTtnUrlLabel.classList.add("focus-ttlWeb-label");
        } else if (!new RegExp("^[a-z A-Z.]*$").test(objLivDtlSecInpt.getTtnNameInpt.value)) {
            objLivDtlSecInpt.getErrLblTag.innerHTML = `No any Special Symbol Allowed!`;
            objLivDtlSecInpt.getTtnNameIcon.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i>`;
            objLivDtlSecInpt.getTtnNameLabel.classList.add("focus-ttlName-label");
            objLivDtlSecInpt.getTtnNameIcon.children[0].style.color = "var(--error)";
        } else if (!new RegExp("^[a-z-A-Z0-9.]*$").test(objLivDtlSecInpt.getTtnUrlInpt.value)) {
            objLivDtlSecInpt.getErrLblTag.innerHTML = `Only "-" Dash Symbol, digits and alphabetic char allowed.`;
            objLivDtlSecInpt.getTtnUrlIcon.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i>`;
            objLivDtlSecInpt.getTtnUrlLabel.classList.add("focus-ttlWeb-label");
            objLivDtlSecInpt.getTtnUrlIcon.children[0].style.color = "var(--error)";
        } else {

            // this is our final user information object 
            if (res.iss !== "https://accounts.google.com") {
                actualUserInfoObj = new actualFinalUserData(verfEmailObj.getNewUserEmailInpt.value, objPwdSectionInpt.getPwdUserInpt.value, objLivDtlSecInpt.getTtnNameInpt.value, objLivDtlSecInpt.getTtnUrlInpt.value);
            } else {
                actualUserInfoObj = new actualFinalUserData(res.email, this.stringGenerator(8), objLivDtlSecInpt.getTtnNameInpt.value, objLivDtlSecInpt.getTtnUrlInpt.value);
            }

            fetch("../PHP/register.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(actualUserInfoObj)
            }).then((response) => {
                return response.text()
            }).then((data) => {
                if (data == 1) {
                    window.location.href = "../Users/Tution/dashboard.html";
                }
                else {
                    console.log(data);
                }
            })
            objLivDtlSecInpt.getErrLblTag.style.color = "var(--valid)";
            objLivDtlSecInpt.getErrLblTag.innerHTML = `Done!, Successfully Saved Information`;

        }

        setTimeout(() => {
            objLivDtlSecInpt.getErrLblTag.innerHTML = ``;
            objLivDtlSecInpt.getErrLblTag.style.color = "var(--error)";
            objLivDtlSecInpt.getTtnNameLabel.classList.remove("focus-ttlName-label");
            objLivDtlSecInpt.getTtnUrlLabel.classList.remove("focus-ttlWeb-label");
            objLivDtlSecInpt.getTtnUrlIcon.innerHTML = `<i class="fa-solid fa-link"></i>`;
            objLivDtlSecInpt.getTtnNameIcon.innerHTML = `<i class="fa-solid fa-chalkboard-user"></i>`;
            objLivDtlSecInpt.getTtnUrlIcon.children[0].style.color = "var(--icon)";
            objLivDtlSecInpt.getTtnNameIcon.children[0].style.color = "var(--icon)";
        }, 3000);
    }
}



class actualFinalUserData {
    constructor(userEmail, userPassword, tuitionName, tuitionUrlName) {
        this.userEmail = userEmail;
        this.userPassword = userPassword;
        this.tuitionName = tuitionName;
        this.tuitionUrlName = tuitionUrlName;
    }
}

let objOtpSectionInpt;
let objPwdSectionInpt;
let objLivDtlSecInpt;
let actualUserInfoObj;

let verfEmailObj = new verifyEmailInpt("verifyEmailIcon", "verifyTrackLine", "newUserEmailLabel", "newUsrEmailInpt", "verifyEmailErrMsgLbl", "verifyEmailBtn", "newUserEmailIconWrap", "sectionNewUserEmail", "sectionVerifyOtpEmail", "actualValidUserEmail", "sectionPwdAccount", "sectionTuitionDtl");
console.log(verfEmailObj)
verfEmailObj.getVerifyEmailBtn.addEventListener("click", () => {
    console.log("ok")
    if (verfEmailObj.getNewUserEmailInpt.value == "") {
        verfEmailObj.getErrLblTag.innerHTML = `Please, Enter your email!`;
        verfEmailObj.getNewUserEmailLblTag.classList.add("focus-newUseremail-lbl");
    } else if (new RegExp('^[A-Za-z0-9._]+@gmail.com').test(verfEmailObj.getNewUserEmailInpt.value)) {
        // only true then go ahed.
        let saveInnerHtml = verfEmailObj.getVerifyEmailBtn.innerHTML;
        verfEmailObj.getVerifyEmailBtn.innerHTML = `Sending ...`;
        verfEmailObj.getVerifyEmailBtn.setAttribute("disabled", "true");

        // send otp in mail
        fetch("../PHP/sendotp.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'userEmail': verfEmailObj.getNewUserEmailInpt.value,
                'isRequested': true,
            })
        }).then((response) => {
            return response.text()
        }).then((data) => {
            if (data == 1) {
                console.log(data);
                verfEmailObj.getVerifyEmailBtn.innerHTML = saveInnerHtml;
                // focus Verification tracker
                document.getElementById("verifyTrackWrap").classList.add("visible-verify-wrap");

                // Show first verification section
                verfEmailObj.getNewUserEmailSecWrapper.classList.add("unshow-default-newuserEmail-wrap")
                verfEmailObj.getVerifyEmailWrapper.classList.remove("unshow-verifyemail-otp-wrapper")
                verfEmailObj.getSpanOfValidUserEmailLabel.innerHTML = `${verfEmailObj.getNewUserEmailInpt.value}`;
            }
            // 2 means user already exist
            else if (data == 2) {
                verfEmailObj.getErrLblTag.innerHTML = `User already exist ! Please login your self.`;
                verfEmailObj.getVerifyEmailBtn.innerHTML = saveInnerHtml;
                verfEmailObj.getVerifyEmailBtn.removeAttribute("disabled");
            }
            else {
                console.log(data);
            }

            document.getElementById("verifyTrackWrap").classList.add("visible-verify-wrap");

            // Show first verification section
            verfEmailObj.getNewUserEmailSecWrapper.classList.add("unshow-default-newuserEmail-wrap")
            verfEmailObj.getVerifyEmailWrapper.classList.remove("unshow-verifyemail-otp-wrapper")
            verfEmailObj.getSpanOfValidUserEmailLabel.innerHTML = `${verfEmailObj.getNewUserEmailInpt.value}`;
        })

        document.getElementById("editNewUserEmailBtn").addEventListener("click", () => {
            verfEmailObj.getVerifyEmailWrapper.classList.add("unshow-verifyemail-otp-wrapper")
            verfEmailObj.getNewUserEmailSecWrapper.classList.remove("unshow-default-newuserEmail-wrap")
        });

        objOtpSectionInpt = new otpSectionInpt("verifyEmailIcon", "verifyTrackLine", "mailOTPLabel", "emailOTPInpt", "ValidateEmailOTPErrMsgLbl", "userEmailOtpIcon", "pwdTrackIcon", "validateOtpBtn");

        let verificationStatus;
        objOtpSectionInpt.getOtpValidateBtn.addEventListener("click", async () => {
            console.log(objOtpSectionInpt.getOtpEmailInpt);
            // here await is necessary because in response of this request we get to know about whether otp is verified or not in verificationStatus variable but because of async fetch that will run background and furthur code run first so that affect to get error.
            await fetch("../PHP/sendotp.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'userOTPValue': objOtpSectionInpt.getOtpEmailInpt.value,
                    'isRequested': "verification"
                })
            }).then((response) => {
                return response.text()
            }).then((data) => {
                // 0 for false and 1 for true
                verificationStatus = data;
            })

            if (objOtpSectionInpt.getOtpEmailInpt.value == "") {
                objOtpSectionInpt.getErrLblTag.innerHTML = `Please, Enter Verification Code!`;
                objOtpSectionInpt.getOtpEmailLabelTag.classList.add("foucs-useremail-otp");
            } else if (verificationStatus == 0) { // 0 false - Not verified
                objOtpSectionInpt.getErrLblTag.innerHTML = `Please, Enter Valid Verification Code!`;
                objOtpSectionInpt.getOtpEmailLabelTag.classList.add("foucs-useremail-otp");
                objOtpSectionInpt.getOtpEmailIconTag.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i>`;
                objOtpSectionInpt.getOtpEmailIconTag.children[0].style.color = "var(--error)";
            } else if (verificationStatus == 1) { // 1 true - Verified
                objOtpSectionInpt.getErrLblTag.innerHTML = `Done!, Your Email is verified.`;
                // objOtpSectionInpt.getOtpValidateBtn.setAttribute("disabled");
                objOtpSectionInpt.getErrLblTag.style.color = "var(--valid)";
                objOtpSectionInpt.getOtpEmailIconTag.children[0].style.color = "var(--valid)";
            // /**/ if (objOtpSectionInpt.getOtpEmailInpt.value == "") {
            //     objOtpSectionInpt.getErrLblTag.innerHTML = `Please, Enter Verification Code!`;
            //     objOtpSectionInpt.getOtpEmailLabelTag.classList.add("foucs-useremail-otp");
            // } else if (objOtpSectionInpt.getOtpEmailInpt.value != 1234) { // 0 false - Not verified
            //     objOtpSectionInpt.getErrLblTag.innerHTML = `Please, Enter Valid Verification Code!`;
            //     objOtpSectionInpt.getOtpEmailLabelTag.classList.add("foucs-useremail-otp");
            //     objOtpSectionInpt.getOtpEmailIconTag.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i>`;
            //     objOtpSectionInpt.getOtpEmailIconTag.children[0].style.color = "var(--error)";
            // } else if (objOtpSectionInpt.getOtpEmailInpt.value == 1234) { // 1 true - Verified
            //     objOtpSectionInpt.getErrLblTag.innerHTML = `Done!, Your Email is verified.`;
            //     // objOtpSectionInpt.getOtpValidateBtn.setAttribute("disabled");
            //     objOtpSectionInpt.getErrLblTag.style.color = "var(--valid)";
            //     objOtpSectionInpt.getOtpEmailIconTag.children[0].style.color = "var(--valid)"; //

                // focus verify tracker line
                document.getElementById("verifyTrackLine").classList.add("visible-tracker-line");

                setTimeout(() => {
                    // move to password wrapper ...
                    // focus password tracker
                    document.getElementById("pwdTrackWrap").classList.add("visible-verify-wrap");

                    // show password section wrapper
                    verfEmailObj.getNewUserEmailSecWrapper.classList.add("unshow-default-newuserEmail-wrap")
                    verfEmailObj.getVerifyEmailWrapper.classList.add("unshow-verifyemail-otp-wrapper")
                    verfEmailObj.getPwdSectionWrapper.classList.remove("unshow-passwordemail-acc-wrapper");

                    objPwdSectionInpt = new pwdSectionInpt("pwdTrackIcon", "pwdTrackLine", "liveTrackIcon", "pwdUserAccLabel", "confirmPwdUserAccLabel", "verifyPwdMsgLbl", "pwdUserAccInpt", "confirmPwdUserAccInpt", "pwdIconWrapper", "pwdConfirmIconWrapper", "hdShwRegPwdBtn", "hdShwRegCnfPwdBtn", "pwdNextBtn");

                    //regex for password 
                    let regExpPwd = new RegExp("(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})");
                    objPwdSectionInpt.getPwdStoreBtn.addEventListener("click", () => {
                        if (objPwdSectionInpt.getPwdUserInpt.value == "" && objPwdSectionInpt.getConfirmPwdUserInpt.value == "") {
                            objPwdSectionInpt.getErrLblTag.innerHTML = "Please, Write Password to keep secure your account!";
                            objPwdSectionInpt.getPwdLabelTag.classList.add("focus-pwdlabel-wrap");
                            objPwdSectionInpt.getCnfPwdLabelTag.classList.add("focus-pwdlabel-wrap");
                        } else if (objPwdSectionInpt.getPwdUserInpt.value == "" || objPwdSectionInpt.getConfirmPwdUserInpt.value == "") {
                            objPwdSectionInpt.getErrLblTag.innerHTML = "Please, Enter Password in both the fields";
                            if (objPwdSectionInpt.getPwdUserInpt.value == "") {
                                objPwdSectionInpt.getPwdLabelTag.classList.add("focus-pwdlabel-wrap");
                            } else {
                                objPwdSectionInpt.getCnfPwdLabelTag.classList.add("focus-pwdlabel-wrap");
                            }
                        }
                        else if (regExpPwd.test(objPwdSectionInpt.getPwdUserInpt.value)) {
                            if (objPwdSectionInpt.getPwdUserInpt.value == objPwdSectionInpt.getConfirmPwdUserInpt.value) {
                                objPwdSectionInpt.getErrLblTag.innerHTML = "Saved";
                                objPwdSectionInpt.getErrLblTag.style.color = "var(--valid)";
                                // focus password tracker line
                                document.getElementById("pwdTrackLine").classList.add("visible-tracker-line");


                                setTimeout(() => {
                                    // focus live tracker
                                    document.getElementById("liveTrackWrap").classList.add("visible-verify-wrap");

                                    // show livesection wrapper
                                    // show password section wrapper
                                    verfEmailObj.getNewUserEmailSecWrapper.classList.add("unshow-default-newuserEmail-wrap")
                                    verfEmailObj.getVerifyEmailWrapper.classList.add("unshow-verifyemail-otp-wrapper")
                                    verfEmailObj.getPwdSectionWrapper.classList.add("unshow-passwordemail-acc-wrapper");
                                    verfEmailObj.getLiveTtlDtlSectWrap.classList.remove("unshow-tuitionDtlRegSec-wrapper");

                                    objLivDtlSecInpt = new liveDtlSectionInpt("ttnNameLabel", "ttnNameInpt", "ttnIconWrap", "ttnWebNameLabel", "ttnWebNameInpt", "ttnwebIconWrap", "finalVerfDtlLabelMsg", "finalRegDtlBtn");

                                    objLivDtlSecInpt.getfinalRegDtlBtn.addEventListener("click", objLivDtlSecInpt.clickHandler);

                                }, 2000);
                            } else {
                                objPwdSectionInpt.getErrLblTag.innerHTML = "Please enter same password on both the feilds.";
                                objPwdSectionInpt.getPwdIconWrap.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i>`;
                                objPwdSectionInpt.getPwdIconWrap.children[0].style.color = "var(--error)";
                            }
                        } else {
                            objPwdSectionInpt.getErrLblTag.innerHTML = "Password should contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character";
                            objPwdSectionInpt.getPwdIconWrap.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i>`;
                            objPwdSectionInpt.getPwdIconWrap.children[0].style.color = "var(--error)";
                        }


                        setTimeout(() => {
                            objPwdSectionInpt.getErrLblTag.innerHTML = "";
                            objPwdSectionInpt.getPwdLabelTag.classList.remove("focus-pwdlabel-wrap");
                            objPwdSectionInpt.getCnfPwdLabelTag.classList.remove("focus-pwdlabel-wrap");
                            objPwdSectionInpt.getPwdIconWrap.innerHTML = `<i class="fa-solid fa-key"></i>`;
                            objPwdSectionInpt.getPwdConfirmIconWrap.innerHTML = `<i class="fa-solid fa-key"></i>`;
                            objPwdSectionInpt.getPwdIconWrap.children[0].style.color = "var(--icon)";
                            objPwdSectionInpt.getPwdConfirmIconWrap.children[0].style.color = "var(--icon)";
                        }, 4000);
                    })

                    objPwdSectionInpt.getPwdHdShBtn.addEventListener("click", (e) => showPass(e));
                    objPwdSectionInpt.getCnfPwdHdShwIconId.addEventListener("click", (e) => showPass(e));

                    //function to convert password fields to text & vice-versa
                    const showPass = (e) => {
                        if (e.target.previousElementSibling.getAttribute("type") == "text") {
                            e.target.previousElementSibling.setAttribute("type", "password");
                            e.target.classList = 'far fa-eye-slash';
                        } else {
                            e.target.previousElementSibling.setAttribute("type", "text");
                            e.target.classList = 'far fa-eye';
                        }
                    }
                }, 3000);
            } else {
                objOtpSectionInpt.getErrLblTag.innerHTML = `Something went wrong!`;
            }

            setTimeout(() => {
                objOtpSectionInpt.getErrLblTag.innerHTML = ``;
                objOtpSectionInpt.getErrLblTag.style.color = "var(--error)";
                objOtpSectionInpt.getOtpEmailLabelTag.classList.remove("foucs-useremail-otp");
                objOtpSectionInpt.getOtpEmailIconTag.innerHTML = `<i class="fa-solid fa-envelope-open-text"></i>`;
            }, 3000);
        })
    } else {
        verfEmailObj.getErrLblTag.innerHTML = `Please, Enter Valid email!`;
        verfEmailObj.getNewUserEmailLblTag.classList.add("focus-newUseremail-lbl");
        verfEmailObj.getNewUserEmailIconTag.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i>`;
        verfEmailObj.getNewUserEmailIconTag.children[0].style.color = "var(--error)";
    }

    setTimeout(() => {
        // reset
        verfEmailObj.getErrLblTag.innerHTML = ``;
        verfEmailObj.getNewUserEmailLblTag.classList.remove("focus-newUseremail-lbl");
        verfEmailObj.getNewUserEmailIconTag.innerHTML = `<i class="far fa-envelope"></i>`;
    }, 2000);
})


/*Callback function for google login */

function decodeJwtResponse(token) { //function to decode JWT token return by Google provider
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function (c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
}

//callback function for google provider id
async function onSignIn(CredentialResponse) {
    const responsePayload = decodeJwtResponse(CredentialResponse.credential);
    if (responsePayload === undefined || responsePayload === null) {
        console.log("Error occured!")    //responsePayload is object return by google with auth details; email , name etc.
    } else {
        await fetch("../PHP/user_check.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                'email': responsePayload.email
            }),
        }).then((res) => {
            return res.text();
        }).then((data) => {
            //if user exist(i.e. data == 1) then display in error label
            if (data == 1) {
                // document.getElementById('verifyEmailErrMsgLbl').innerHTML = 'User already exist ! Please login your self.';
                // setTimeout(() => {
                //     document.getElementById('verifyEmailErrMsgLbl').innerHTML = '';
                // }, 3000);
                window.location.href = "../Users/Tution/Dashboard.html";
                return;
            } else {
                verfEmailObj.getNewUserEmailSecWrapper.classList.add("unshow-default-newuserEmail-wrap")
                verfEmailObj.getVerifyEmailWrapper.classList.add("unshow-verifyemail-otp-wrapper")
                verfEmailObj.getPwdSectionWrapper.classList.add("unshow-passwordemail-acc-wrapper");
                verfEmailObj.getLiveTtlDtlSectWrap.classList.remove("unshow-tuitionDtlRegSec-wrapper");


                //for adding trackers
                document.getElementById("pwdTrackLine").classList.add("visible-tracker-line");
                document.getElementById("liveTrackWrap").classList.add("visible-verify-wrap");
                document.getElementById("verifyTrackWrap").classList.add("visible-verify-wrap");
                document.getElementById("verifyTrackLine").classList.add("visible-tracker-line");
                document.getElementById("pwdTrackWrap").classList.add("visible-verify-wrap"); 4

                objLivDtlSecInpt = new liveDtlSectionInpt("ttnNameLabel", "ttnNameInpt", "ttnIconWrap", "ttnWebNameLabel", "ttnWebNameInpt", "ttnwebIconWrap", "finalVerfDtlLabelMsg", "finalRegDtlBtn");

                objLivDtlSecInpt.getfinalRegDtlBtn.addEventListener("click", () => { objLivDtlSecInpt.clickHandler(responsePayload) });
            }
        })
    }

}