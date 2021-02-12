# trackEmail

PHP Send and Track Emails (Email Opening)

It is necessary to have PHPMailer to send the emails in that way, but if you do not want to use composer it is possible use the normal php mail() function as well.

Class folder has the database connection and the class to send emails.

Includes folder it has the php files used for calling the classes, sending emails and load Ajax requests from main.js.


Email folder has the email templates, they are very simple, it is just for exemplification. 

The index.html file has a simple example on how we could use to send emails and also to track if email were open or not. 
Basically there is a form to submit the email template from the email folder. And there is a table from MySql that will show which emails were open or not.

