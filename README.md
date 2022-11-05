<img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Asterisk.svg" alt="Asset Risk Manager">

# Asset Risk Manager

Asset Risk Manager is a Laravel/PHP application to help organization or entities manage their assets and respective
risks in accordance with [EU Directive 2016/1148](https://eur-lex.europa.eu/eli/dir/2016/1148/oj)
and [Portuguese Law 46/2018](https://www.cncs.gov.pt/docs/regime-jurdico-da-segurana-do-ciberespao.pdf) (Regime Jurídico
da Segurança no Ciberespaço) as defined by [CNCS](https://www.cncs.gov.pt/pt/regime-juridico/) (Centro Nacional de
Cibersegurança).

**The instructions for this application installation are provided in [INSTALL.md](INSTALL.md).**

The intended usage of this application, after promoting the initial setup user to an Administrative role, is to add
multiple users of the LDAP organization to the application by logging them in, assigning them the intended role
afterwards (Data Protection Officer, Security Officer, Administrator or Asset Manager). Each user has an intended set of
permissions, with the Data Protection Officer being able to oversee (but not interact) with the asset and risk
management process, the security officer being able to manage the asset and risk management process of any asset and the
asset manager being able to manage the processes of the assets that they're currently assigned to (and visible), with
the administrator being able to modify the roles of any user (and toggle their status in the system).

The intended flow of these processes is for a security officer to add an asset to the system, defining the linked asset
to said asset and the intended manager (a user that's present on the system), followed by the risk evaluation (and
properties management) of said asset by its manager, risk management (management of threats and their respective
controls) and final risk acceptance by the security officer.

The security officer must add all possible threats and
respective controls that will be used in the risk management process of an asset beforehands, as well as information
concerning the permanent contact point and security officers to comply with the aformentioned Portuguese law.
All the management and report generation activities are available according to the currently logged-in user roles in
the respective menus, commonly accessed through the top navigation menu.

This project is licensed under the [AGPL 3 license](https://www.gnu.org/licenses/agpl-3.0.en.html), a copy of which may
be found on [LICENSE](LICENSE).

![Asset Risk Management submenu](documentation/asset_risk_management_process.png?raw=true "Asset Risk Management submenu")
*The Asset Risk Management submenu*


