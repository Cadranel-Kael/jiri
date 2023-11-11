# Jiri

## Database

### Tables

**Users**

*Users using the application. There can only be one user for an event.*

- Name (varchar)

  - admin

- Email (varchar) (unique)

  - admin@mail.com

- Password (varchar)

  - $2y$10$92IXUNpkjO0rO

    

**Contacts**

*Created by users and used in events. The role is not defined here because it can change depending on the event.*

- Name (varchar)

  - Katlyn Auer

- Email (varchar)

  - kaytlyn.auer@mail.com

- Image_url (varchar)

  - https://via.placeholder.com/640x480.png/00bbff?text=atque

- User_id (fk)

  

**Projects**

- Name (varchar)

  - Portfolio

- Description (varchar)

  - A project...

- Tags (json)

  - [Implementation, WordPress]

- Urls (json) (nullable)

  - *The links for the overall project*
  - [https://github.com/]

- User_id (fk)

  

**Events**

- Name (varchar)

  - Bloc 2024-2025

- Date (date)

  - *Date programmed, updated when ended to the current date*
  - 14/06/2025

- Status (varchar)

  - *Status of the event (toBe, started, ended)*

- Duration (Time) (nullable)

  - *Time of the event, only started when the event has started* 

- User_id (fk)

  

**Events_projects**

- Weight (int)
  - *By default 1*
- Event_id (fk)
- Project_id (fk)



**Participants**

- Token (varchar) (nullable)

- Role (varchar) (student or evaluator)

  - *Role during the event, can be student or evaluator*

- Contact_id (fk)

- Event_id (fk)

  

**Participations**

- Scores (json)
  - *The points received during an event*
  - **Format:** contact_id (jury) => points (out of 100) 
  - [[ '2' => '56'], [ '3' => '56']]
- Comments (json)
  - *The comments received during an event*
  - **Format:** contact_id (jury) => comment 
  - [[ '2' => 'Very well done...'], [ '3' => 'Overall great project']]
- Urls (json)
  - *The links for the specific project of the student*
  - [https://github.com/]
- Contact_id (fk)
  - *Id of the student*
- Project_id (fk)





### Relations

**User**

- Has many **contacts** (contacts)

- Has many **projects** (projects)

- Has many **events** (events)

  

**Contacts**

- Belongs to one **user** (users)
- Has many **projects** (projects)
- Has many **participations** (participations)



**Projects**

- Belongs to one **user** (users)
- Belongs to many **contacts** (contacts)



**Events**

- Belongs to **user** (users)
- Has many **participants** (participants)
- Has many **projects** with weight (projects)
- Has many **contacts** (contacts with particpants)
- Has many **students** (contacts with participants)
- Has many **evaluators** (contacts with participants)



**Participants**

- Belongs to one **event** (events)



**Participations**

- Has one **project** (projects)
- Has one **student** (contacts)











