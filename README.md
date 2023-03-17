# Web_Services_Labs_ITI
## Day1
## Getting weather by Curl and Guzzle:
### video demo


https://user-images.githubusercontent.com/90557756/225907548-36bf0cc4-14cb-41b1-89a1-556113a69a22.mp4

## Day2
| Product | Endpoints | Action |
| --- | --- | --- |
| GET | /Web_Service/Lab2/index.php/products/ | get all products |
| GET | /Web_Service/Lab2/index.php/products/id | get a product by its id |
| POST | /Web_Service/Lab2/index.php/products/ | add product  |
| PUT | /Web_Service/Lab2/index.php/products/id | update a product by its id  |
| DELETE | /Web_Service/Lab2/index.php/products/id | delete a product by itsid |

### products body Example

```
   [
    {
        "id": "2",
        "name": "Product 2",
        "price": "60",
        "units_in_stock": "10"
    },
    {
        "id": "3",
        "name": "Product 3",
        "price": "80",
        "units_in_stock": "10"
    },
]
```
