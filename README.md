# Amazoff - Symfony Application

## Cloning the project
- You can download the project directly as a zip file.
						Or
- Clone the project using: `git clone https://github.com/EpitechMscProPromo2025/T-WEB-600-LIL-6-1-ecommerce-lucas.redjaimia.git`
						Or
- Clone the project using the ssh key, but you have to create a ssh key in your git account. Follow this documentation for more: https://docs.gitlab.com/ee/user/ssh.html and type this command when you're done: `git clone git@github.com:EpitechMscProPromo2025/T-WEB-600-LIL-6-1-ecommerce-lucas.redjaimia.git`

## Installation

```bash
  ansible-playbook -i hosts.ini playbook.yaml
```

## Project routes
```html
/api/register             : Create the user
/api/login                : Log the user into the app
/api/users                : Display and modify user profile information
/api/products             : Give the product list
/api/products/{productId} : Give one product information
/api/carts                : Display the current cart
/api/carts/{productId}    : Remove the product from the cart 
/api/carts/validate       : Convert the cart into an order
/api/orders               : Display every order from the logged user
/api/orders/{orderId}     : Display one order from the current user
```


## Copyrights
All rights reserved - Amazoff.com © 2022 - Present
