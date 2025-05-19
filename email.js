function sendEmail() {
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const message = document.getElementById("message").value;
  const time = new Date().toLocaleString();

  const params = { name, email, message, time };

  // 1. Send via EmailJS
  emailjs
    .send("service_lm9yw53", "template_prk4gqv", params)
    .then(() => {
      alert("✅ Email Sent!");

      // 2. Save to CSV via PHP
      fetch("save.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          Name: name, // PHP is case-sensitive
          email: email,
          message: message,
        }).toString(),
      }).catch((err) => {
        console.error("⚠️ Failed to save to CSV:", err);
      });
    })
    .catch((err) => {
      console.error("❌ Failed to send email:", err);
      alert("❌ Email not sent. Try again later.");
    });
}
