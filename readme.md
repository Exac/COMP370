
#14.16
Starting with your specifications of Problem 12.20 or 13.22, design the Chocoholics Anonymous product (Appendix A). Use the 9-step process.
##Design Descisions
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

##Mapping of Analysis Classes to Design Classes
Analysis classes map to design classes.

The **ChocAnSystem** class creates the provider (terminal?), operator and, manager interfaces.

The **UserInterface** class handles the four user interfaces (**ProviderInterface**, **OperatorInterface**, **ManagerInterface** and, **SchedulerInterface**. They are used for all output.

The entity classes have their information stored in the database. Each entry holds the data for one entity class (**Members**, **Providers**, **Persons**, **Services** and **Claims**).
**ProviderMaintainer** and **MemberMaintainer** inherit **PersonMaintainer**.

**Report** is the superclass behind all the report classes. **DateRangeReport** is a subclass of report that limits the date-range of reports.

**MemberReportGenerator** saves all reports.

