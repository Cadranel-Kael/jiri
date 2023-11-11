# Jiri

## Database

### Tables

**Users**

*Users using the application. There can only be one user for an event.*

- Name (varchar)

- Email (varchar) (unique)

- Password (varchar)

  

**Contacts**

*Created by users and used in events. The role is not defined here because it can change depending on the event.*

- Name (varchar)

- Email (varchar)

- Image_url (varchar)

- User_id (fk)

  

**Projects**

- Name (varchar)

- Description (varchar)

- Tags (json)

  - **Format**: [project1, project2...]

- Urls (json) (nullable)

  - *The links for the overall project*
  - **Format**: [link]

- User_id (fk)

  

**Events**

- Name (varchar)

- Date (date)

  - *Date programmed, updated when ended to the current date*

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
- Comments (json)
  - *The comments received during an event*
  - **Format:** contact_id (jury) => comment 
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
