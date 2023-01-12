# Request. Inquiries. Concerns. Komersiyo (RICK) Ticketing System

### Click [**_here_**](http://vast-headland-55467.herokuapp.com/) to access deployed system

### Student Perspective
To submit a ticket, you may use any of the Gmail accounts below:
|        Name        |            Email           |   Password   |
|--------------------|----------------------------|--------------|
| Sebastian Ocampo|   socampo.capstone@gmail.com   | Capstone246~ |
| Paz Cembrano | pcembrano.capstone@gmail.com | Capstone246~ |
| Eleanor Rivera | erivera.capstone@gmail.com | Capstone246~ |

### Front Desk Officer (FDO) and Admin Perspective
Access the system using the following accounts:
|        Role        |            Email           |   Password   |
|--------------------|----------------------------|--------------|
| Front Desk Officer (FDO) | socampo.capstone@gmail.com | Newpass1234~ |
|       Admin        |   johnpdoe.246@gmail.com   | Newpass1234~ |

## Project Overview
### Client: 
University of Santo Tomas College of Commerce and Business Administration
### Problem: 
When classes were shifted to remote learning, the college has been handling student concerns manually using email, social media, and Zoom. 
Instead, the faculty and staffs have to allocate their time to address these concerns. 
Students are only updated once their concern has been fully addressed, thus lacking in interaction.
### Solution: 
A web-based ticketing system that serves as a single point of contact, and enables the client to manage student requests, inquiries, and concerns in a centralized manner by applying ITIL 4 practices. <br /><br />
Service Desk serves as a single point of contact for the students to submit their requests, inquiries, and concerns. Students can submit or reopen tickets using the system. To promote engagement, students receive notifications through their email.
<br /><br />
Service Request Management is a set of processes applied to enable our client operate effectively in addressing student concerns, and improve the student's satisfaction during service request fulfillment. 
The following Service Request Management practices were implemented: <br />
1. **Ticket Management.** Tickets are automatically assigned by the system based on the category specified by the student. <br />
2. **Ticket Categorization.** Ticket are categorized into requests, inquiries, or concerns.  <br />
3. **System Notifications** Users are notified when a ticket has been assigned or transferred to them. <br />
4. **Status.** There are 7 ticket status: (1)New, (2)Opened, (3)Ongoing, (4)Resolved, (5)Inactive, (6)Voided, and (7)Reopened
5. **Ticket Prioritization.** To enable the assigned Front Desk Officer manage tickets based on urgency, the priority level of a ticket can be set as (1)High, (2)Medium, and (3)Low.
6. **Transfer Tickets.** The assigned Front Desk Officer can transfer miscategorized tickets to another category and/or Front Desk Officer.

## Screenshots From the System

#### Home Page
Service Desk that serves as the single point of contact for students to send their tickets.
![image](https://user-images.githubusercontent.com/110912017/211799405-f902bd95-2425-4112-8f4f-32b4da7c9ecf.png)

Students may submit or reopen a ticket provided that: <br />
1. They used their UST email <br />
2. They have verified their email address with the provided verification code 
![image](https://user-images.githubusercontent.com/110912017/211825133-57eb5555-bad1-4c73-91aa-682f4864bf7d.png)
![image](https://user-images.githubusercontent.com/110912017/211824777-1ac89f74-6b7c-4733-8518-1a35b10ee456.png)

#### Submit Tickets Page (Student)
If the student's concern is not found in the list of categories, the student may choose "Others", and provide their own category.
![image](https://user-images.githubusercontent.com/110912017/211812806-bf3b6074-f641-49eb-96a5-8812c6fefca5.png)

#### Email Updates (Student)
To keep students updated with the status of their tickets, the system provides email notifications when changes are made to the ticket.
![image](https://user-images.githubusercontent.com/110912017/211815999-d07a1b98-49d4-4580-a528-0df5c6f7f063.png)

#### View Previous Tickets to Reopen (Student)
Students may request to reopen a previous ticket if they encounter the same problem or if the concern was not resolved. 
![image](https://user-images.githubusercontent.com/110912017/211817420-b055d296-4d61-4c37-80c2-043f0d439b85.png)

#### Request to Reopen Tickets (Student)
A reason must be provided to reopen a ticket. By default, the reopened ticket will be assigned to the previous FDO who was assigned, but the student may also decide whether they want the system to assign a different FDO.
![image](https://user-images.githubusercontent.com/110912017/211823520-c108f08a-93fb-4cf7-8ed4-77d0c6add363.png)
![image](https://user-images.githubusercontent.com/110912017/211823623-dc9fa85d-ba2b-493b-a738-a06aaa9cabdf.png)
![image](https://user-images.githubusercontent.com/110912017/211823704-857d2ff2-aff7-48e3-b990-d6f4d14e2d27.png)

#### Login (FDO and Admin)
![image](https://user-images.githubusercontent.com/110912017/211835821-8187b581-10ef-4920-80ce-dc7d7fe78987.png)

#### View Tickets (FDO and Admin)
![image](https://user-images.githubusercontent.com/110912017/211826505-855e57f1-7698-48dd-a466-26e75ef97c8b.png)

#### View Single Ticket (FDO and Admin)
Users can view all tickets, but only the assigned FDO can modify the ticket.
![image](https://user-images.githubusercontent.com/110912017/211827464-e4edd32e-d8a6-47dc-b65b-2c6287745ce0.png)

#### Dashboard (FDO and Admin)
Users can view the dashboard that contains the key performance metrics, summary of tickets for the month, and charts to help the client visualize their data.
![image](https://user-images.githubusercontent.com/110912017/211820986-f71609f0-fbbd-4277-815b-0af6687e64ff.png)
![image](https://user-images.githubusercontent.com/110912017/211821150-880d1d69-2d1f-4e25-bbbe-260676c2e5ac.png)
![image](https://user-images.githubusercontent.com/110912017/211821401-096a19cc-9b51-4551-8541-e7306b355bf2.png)

#### Generate Report (Admin)
Admin users can download an Excel file of the report by clicking "Generate Report"
![image](https://user-images.githubusercontent.com/110912017/211828561-28174fea-b66a-424f-8cae-a73e1fde71cb.png)

#### Change Password (FDO and Admin)
![image](https://user-images.githubusercontent.com/110912017/211828795-f5abbcb4-b0c8-4367-bdc1-110040a3d588.png)

#### View Users (Admin)
![image](https://user-images.githubusercontent.com/110912017/211828924-7ead19b4-5783-4ebd-b1cf-ebc92abffa52.png)

#### View Categories (Admin)
![image](https://user-images.githubusercontent.com/110912017/211829078-3a419ac1-70d4-4a6d-8d4f-02110da3b520.png)

#### Ticket Limitation (Admin)
To prevent students from spmming tickets, Admins can change the number of current tickets each student can have
![image](https://user-images.githubusercontent.com/110912017/211829231-71145993-dda5-4a7d-9538-dfadc5a86faf.png)

#### Student Audit Log (Admin)
![image](https://user-images.githubusercontent.com/110912017/211829441-7760b862-bfd9-4e77-b1ac-fc8496ce438e.png)

#### User Audit Log (Admin)
![image](https://user-images.githubusercontent.com/110912017/211831494-6ef10ec1-4020-4c67-9a81-3b48bf9b4724.png)

