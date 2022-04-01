# Sprint 4 Planning

## Sprint goal:
 - Finish user stories: __IN-82__, __IN-85__, __IN-87__, __IN-88__, __IN-92__, __IN-97__ for some bug fixes and ensure main features work.


---

## Tasks Breakdown:

Story: __IN-82__ - As a user, I want to buy containers that I am borrowing, so that I have the option to not return them.

Tasks:
 - Add validation to ensure users can only buy containers they are holding
 - Update database when payment is processed for container

---


Story: __IN-85__ - As a restaurant, I want to be able to scan containers to an order, so that it can change the status of the container.

Tasks:
 - Ensure scan functionality works
 - Notify Restaurant that a container has been scanned
 - Hookup NFC tag to give container ID

---


Story: __IN-87__ - As an admin, I want to be able to read the data in the container table in a human-friendly way, so I don't have to consult the documentation to decipher the data

Tasks:
 - Map numbers from the database table to their string representation
 - Display mapped strings instead of numbers in the container table

---


Story: __IN-88__ - As a restaurant, I want to be able to assign containers to each order item, so that I can track the containers that are given to customers

Tasks:
 - Map container status numbers to descriptions (ex: 1->'pending')
 - Connect container status to each container associated with an order

---


Story: __IN-92__ - As an admin, I want to be able to sort containers by their attributes, so I can easily identify containers
Tasks:
 - Add sorting for restaurant name
 - Add sorting for date

---

Story: __IN-97__ - As a user, I want to see the change order status buttons as a dropdown menu, so that I can have an easy to view interface

Tasks:
 - Change dropdown menu to be on by default and remove update and cancel buttons

---



## Spikes:
- None

---

## Capacity
| Name | Capacity (hours per day) |
| --- | --- |
| Sabih Sarowar | 2 |
| Arthur Ng | 2 |
| Rayhan Fazal | 2 |
| Kevin Shin | 2 |
| Longyu Li | 2 |
| Raghav Sharma | 2 |


## Participants
- Sabih Sarowar
- Arthur Ng
- Rayhan Fazal
- Kevin Shin
- Longyu Li
- Raghav Sharma
