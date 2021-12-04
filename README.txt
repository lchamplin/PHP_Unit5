1. Cross-site scripting (XSS) is a vulnerability that enables hackers to inject client-side script into web pages. Explain the potential issue with using $_SERVER["PHP_SELF"] as the form action, and how to avoid that issue.
Using $_SERVER["PHP_SELF"] allows hackers to inject commands by writing them after a slash. They can inject javascript in this fashion. This issue can be avoided by using htmlspecialchars(), stripslashes()

2. Explain why it's important to have server-side validation, and why you might want both client- and server-side.
Server-side validation is important to prevent cross-site scripting attacks. Client-side validation might be necessary if the user doesn't have javascript. It also reduces data traffic.
