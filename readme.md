#Chocoholics Anonymous Term Project
Farzin Dhanji, Karanvir Gill &amp; Thomas McLennan

###Appendix
1. [14.16](#1416)
  * [Design Decisions](#DesignDecisions)
  * [Mapping of Analysis Classes to Design Classes](#Mapping)
2. [15.33](#1416)
3. [15.34](#1416)

***
##14.16<a name="1416"></a>
_Starting with your specifications of Problem 12.20 or 13.22, design the Chocoholics Anonymous product (Appendix A). Use the 9-step process._
###Design Descisions<a name="DesignDecisions"></a>
1.	An HTML GUI will be used to create the provider, operator & manager interface.
2.	Reports will be saved as html files.
3.	ETF data will be saved to html files.
4.	The system will be implemented in three parts:
a.	A server running Apache2 (object-oriented PHP)
b.	A server running a MySql database holding the claim, member, provider and, service tables.
c.	An arbitrary computing device to connect to the web server.
5.	The operator interface allows updating of a member’s data.
6.	The accounting (Scheduler) can be run manually, or with a cron job every Friday.
7.	Persistent class data is stored in the database, and accessed on run.
8.	Relationships between entity classes (Claim, Service, Provider and, Member) are implemented by identifying indexes stored in the database.
9.	The server-side code will be implemented in PHP and shell scripts. The client-side code will run JavaScript. The database server is MySql.

###Mapping of Analysis Classes to Design Classes<a name="Mapping"></a>
Analysis classes map to design classes.

The **ChocAnSystem** class creates the provider (terminal?), operator and, manager interfaces.

The **UserInterface** class handles the four user interfaces (**ProviderInterface**, **OperatorInterface**, **ManagerInterface** and, **SchedulerInterface**. They are used for all output.

The entity classes have their information stored in the database. Each entry holds the data for one entity class (**Members**, **Providers**, **Persons**, **Services** and **Claims**).
**ProviderMaintainer** and **MemberMaintainer** inherit **PersonMaintainer**.

**Report** is the superclass behind all the report classes. **DateRangeReport** is a subclass of report that limits the date-range of reports.

**MemberReportGenerator** saves all reports.

##15.33<a name="1533"></a>
_Draw up black-box test cases for the product you specified in Problem 12.20 or 13.22. For each test case, state what is being tested and the expected outcome of that test case.
Black-Box Tests_
The functions outlined in the specifications document are outlined in the test cases:

###Black-Box Test Cases
####Database
Equivalence classes for *Database password*.

Password | Result
--- | ---
Password is string | true
Password's first character is alphanumeric | true
Password < 1 character | true

member_number
--- | ---
member_number is created | true



###Functional Analysis Test Cases
1.     Manage Session
2.	Verify Member
3.	Submit Claim
4.	Receive Order
5.	Receive Provider Directory
6.	Maintain Member (Add a new member)
7.	Maintain Member (Update existing member)
8.	Maintain Member (Delete existing member)
9.	Maintain Provider (Add a new provider)
10.	Maintain Provider (Update existing provider)
11.	Maintain Provider (Delete existing provider)
12.	Maintain Service (Add a service)
13.	Maintain Service  (update a service)
14.	Maintain service (delete service)
15.	Request Report (provider report)
16.	Request Report (member report)
17.	Request Report (accounts payable report) (Not implemented in project)

In addition to these direct tests, it is necessary to perform the following additional tests:

1.	Attempt to create a Member
2.	Attempt to create a Member that already exists.


##15.34<a name="1534"></a>
Implement and integrate the Chocoholics Anonymous product (AppendixA). Use the programming language specified by your
instructor. Your instructor will tell you whether to build a Web-based user interface, a graphical user interface, or a
text-based userinterface. Remember to utilize the black-box test cases you developed in Problem 15.33 for testing your
code.
