Task
Develop a web application & API for e-commerce with two users; Business and Customer
Requirements


➔ Web App:
1) Businesses can log in and logout
2) Businesses can manage products (Add, Edit, Delete, View)
3) Customers can register and log in
4) Customers can view products
5) Customers create orders for single products. Each order is attached to a payment method
that the user selects: card or cash.
a) For the cash payment method, no additional information is required. b) For the
payment method of the card, a billing address and card number are required to be
linked to the order.


➔ REST API:
1) Authenticate users (obtain a bearer token)
2) Get a list of the products (Paginated, does not require authentication) 3) Create a new
order (requires authentication, and only customers can create orders)
