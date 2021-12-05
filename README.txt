1. Clearly we don't want to store passwords in plaintext. Do some research and write a short paragraph about what you would do to make your passwords more security.
Passwords can be stored using a hash function. This is very hard to predict and it much more secure. Hashes can be made even more secure with "salting" which is adding unique data at time of input. (source: https://auth0.com/blog/hashing-passwords-one-way-road-to-security/)


2. What are some good/not so good ways to deal with forgotten passwords? List at least one of each.
Good: Have some method of two factor authentication for resetting password email
Not Good: Allowing user to just enter an email to send resetting password email


3. What are some things to consider when implementing "Remember me" functionality? List at least two.
This would need to be stored on the user's end in the browser I think. This way it could be saved over session destruction.


4. What are some best practices for cookies? List at least two.
Some best practices for cookies include not storing any critical information and avoiding permanent cookies.


5. What is https?
It stands for Hypertext Transfer Protocol Secure. Data sent with this method is secured via transport layer security protocol. The data is protected by encryption, data integrity, and authentication.




