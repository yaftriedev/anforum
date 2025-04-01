# The-Anonimous-Forum
The Anonimous Forum

security comprove line: <?php if (!isset($path_test)) { die("Access denied"); } ?>

## Ulrs (inputs and errs)

Post Url
Form (hidden:p, textarea:post)
err: no_register, no_post_exist, post_blank, up255main

Register Url
Form (text:username, password:password, password:cpassword)
err: nick_register, pdm, err

Login Url
Form (text:username, password:password)
err: invalid_credentials, err

Change Password Url
Form (password:oldpassword, password:password, password:cpassword)
err: pdm, oldpassword_invalid, err

logout Url
err: none