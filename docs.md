# Think CRM Task
## Outline

- The task provided requested there to be a [CodeIgniter 3](https://codeigniter.com/userguide3/general/welcome.html) based CRM system.
- It required users to be able to:
  - Create new contacts (first name, last name, email, phone & notes)
  - View the list of contacts (sorted by last name)
  - Search for contacts by the aforementioned fields
  - Edit & Delete Existing Contacts
- It also required server-side validation for fields.

## Implementation
Following CI3's standard MVC patterns, the required task was not too complex to implement. A total of five views, one model & three controllers were created.
### Views

1) **home.php**: The home view contains the vast majority of the application. From the table to view users, to the sorting & links to edit or delete a contact.
2) **header.php**: To allow for easier future expansion and a bit more flexibility, a dedicated header file was created, mainly to house the javascript & CSS libraries used, but also to provide some templating for pages.
3) **footer.php**: Similar to the header file, but this time just the closing tags for `</body>` & `</html>`.
4) **add.php**: The add file is, as the name suggests, the view which users are directed to when adding a new contact to their system. It has both client-side & server-side validation implemented.
5) **edit.php**: Almost identical in form & function to the **add.php** file, but it displays users with pre-filled text boxes of whichever contact they wanted to edit.

**Retrospective:** Looking back at this view implementation, a few things could have been improved. From the way the homepage is generated, to especially the way the add & edit files are generated. If time had been available, it would have been trivial to use the same view file for both add & edit, with just minor server-side tweaks to allow for this. This is something I would include in a "version 2".

### Model
The only model in the entire system is the `People_model`, which provides an OOP way of interacting with the database entries for People or "Persons". It has a few helper functions within it to make adding, getting & updating data within the database more simple to implement.

**Retrospective:** There would be a couple changes I would make in a version 2. Such as improving the get function and adding additional validation to the insert, update & delete functions, beyond relying on the implementation of these functions is correct.

### Controllers
1) **MY_controller.php**: This controller is a simple extension of the default `CI_Controller` and merely adds the `loadWithTemplate` function which is what is used to implement the header and footer views described previously.
2) **MainController.php**: This controller provides the loading of the homepage and loads the people currently within the system, while also sorting them. It also has the ability to flash a message from the session which is then displayed on the homepage.
3) **People_controller.php**: The people controller holds the main bulk of the application, from adding & editing contacts, to deleting them. It also holds the validation function for server-side validation. Including a Regex query for ensuring a phone number matches the British phone number specification.

**Retrospective:** The majority of the functionality outlined within the two main controllers could have been merged into one, but for the sake of a cleaner codebase and easier extendability in the future, it was decided to keep it seperated. For the most part, as much of default CI3 behaviour and functionality was used. However, it is possible that there are some vulnerabilities within the code that may have been missed.

## Database Design
The database design was kept incredibly simple, essentially because the system itself was incredibly simple. I am a firm believer in lightweight database design and dislike over-complex implementations (cough WordPress cough). Overall, the entire system runs on just a single database, indexed by the id of the entry. It would have been reasonable to improve performance of the database by creating an index on the contacts last name & first name. However, unless this system begun to scale to the millions of entries (which it is not intended for), this would be an unnecessary complication.

The table insert for the entire system is quite simply:
```sql
CREATE TABLE people (
	id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	email_address VARCHAR(100),
	phone_number VARCHAR(20),
	notes TEXT,
	date DATETIME
) DEFAULT CHARSET=utf8;
```

## Instructions to run
1) Create an Apache2 or Nginx site called `think.local` which points to this code repository
2) Create a MySQL database called `THINK_CRM` with a charset of `utf8`
3) Create a MySQL user with access to this database with the username of `think` and the password of `password`
4) On that database run the above query
5) Up and running!

## Conclusion

For the most part, I am happy with the implementation I went with, I kept within specification of the task and overall tried to keep everything as light, clean and readable as possible, including block docs on each function and reusable code where necessary.

Everything within the system was intentionally kept as simple as possible, including the use of CDN-based JavaScript & CSS libraries, namely being [Tailwind CSS](https://tailwindcss.com/), a very clean and simple CSS library that offers a lot of utility, and [Alpine JS](https://alpinejs.dev/) an incredibly lightweight JavaScript library, which is more of an extension to vanilla JavaScript than a library.

If I were to tackle this or a similar problem again, I would certainly work on improving the overall security of the system and improve the extensibility of it too.
