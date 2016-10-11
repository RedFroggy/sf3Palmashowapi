Feature: To improve the developer experience of our API

  In order to offer an API user a better experience
  As an API developer
  I need to return useful information when situations may be otherwise confusing


  Background:
    Given there are Users with the following details:
      | uid | username | email          | password | matricule |
      | u1  | peter    | peter@test.com | testpass | 1234     |
      | u2  | john     | john@test.org  | johnpass | 5678     |
    And I am successfully logged in with username: "peter", and password: "testpass"
    And I set header "Content-Type" with value "application/json"
    And I set header "Accept" with value "application/json"


  Scenario: User can add a new Dvd
    When I send a "POST" request to "/api/dvds" with body:
        """
        {
          "image": "https://dl.dropboxusercontent.com/s/g7si1tfx8fl7tfh/very_bad_blagues.jpg",
          "link": "https://www.amazon.fr/Very-Bad-Blagues-meilleur-saisons/dp/B00ESVLAWY?ie=UTF8&qid=1384334420&ref_=sr_1_1&s=dvd&sr=1-1",
          "title": "Very Bad Blagues"
        }
        """
    Then the response code should be 200
    And the response header "Content-Type" should be equal to "application/json"
    And the response should contain json:
        """
        {  "image": "https://dl.dropboxusercontent.com/s/g7si1tfx8fl7tfh/very_bad_blagues.jpg",
          "link": "https://www.amazon.fr/Very-Bad-Blagues-meilleur-saisons/dp/B00ESVLAWY?ie=UTF8&qid=1384334420&ref_=sr_1_1&s=dvd&sr=1-1",
          "title": "Very Bad Blagues"
        }
        """
