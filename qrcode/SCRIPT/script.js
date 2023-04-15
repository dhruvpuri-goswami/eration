function onScanSuccess(decodedText, decodedResult) {
    console.log(`Code scanned = ${decodedText}`, decodedResult);
}
var html5QrcodeScanner = new Html5QrcodeScanner(
	"qr-reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);

function generatorQR(){
    document.getElementById("qrcode").src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + document.getElementById("textInpt").value;
}

let headerNavOFScanner = document.getElementById("qr-reader");
if(headerNavOFScanner !== undefined){
    headerNavOFScanner.children[0].style.display = "none";
}