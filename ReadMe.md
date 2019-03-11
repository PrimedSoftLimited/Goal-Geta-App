# Documentation On GoalGeta  #

## Base Url: localhost/api/register ###

### Request: Post ###

### Fields Required ###

* name: Francis : "string"
* email: francis@example.com : "string"
* phone_number: "08096753454" : "string"
* password: min:5 "string"

#### Register Response ####

{
    "data": {
        "user": {
            "name": "john",
            "email": "john@example.com",
            "phone_number": "08071448735",
            "api_token": "bef7f17ec4bcac947b439079560e8f25669b18cfe0b16014197fa42e406c7b86",
            "updated_at": "2019-03-07 13:18:52",
            "created_at": "2019-03-07 13:18:52",
            "id": 4
        },
        "token": "Bearer bef7f17ec4bcac947b439079560e8f25669b18cfe0b16014197fa42e406c7b86"
    }
}