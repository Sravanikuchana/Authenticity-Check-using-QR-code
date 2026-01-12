function domReady(fn) {
    if (document.readyState === "complete" || document.readyState === "interactive") {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {

    function onScanSuccess(decodeText, decodeResult) {
        console.log("Scanned QR:", decodeText);

        // Call verify.php
        fetch("verify.php?data=" + encodeURIComponent(decodeText))
            .then(res => res.json())
            .then(result => {
                console.log("Verification result:", result);

                // Always provide safe fallback values
                const scanData = {
                    email: localStorage.getItem("user_email") || "guest@example.com",
                    qr_id: result.id ? result.id : decodeText,
                    brand: result.brand ? result.brand : "Unknown",
                    status: result.status ? result.status : "fake"
                };

                // Save scan in DB
                fetch("save_scan.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(scanData)
                })
                .then(r => r.json())
                .then(resp => {
                    console.log("Save response:", resp);
                    // ✅ Redirect only after saving
                    window.location.href = "result.html?data=" + encodeURIComponent(decodeText);
                })
                .catch(err => {
                    console.error("Save error:", err);
                    // Redirect anyway if saving fails
                    window.location.href = "result.html?data=" + encodeURIComponent(decodeText);
                });

            })
            .catch(err => {
                console.error("Verification error:", err);
                window.location.href = "result.html?data=" + encodeURIComponent(decodeText);
            });
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbox: 250 }
    );
    htmlscanner.render(onScanSuccess);
});
