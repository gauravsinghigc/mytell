<?php

/**
 * @SystemFileProcessor
 * 
 * here all system files will be loaded
 *
 */

//some PHP Functions
require __DIR__ . "/SysModules/PHP_Modules/DateTime.php";
require __DIR__ . "/SysModules/PHP_Modules/WorkingOnDates.php";
require __DIR__ . "/SysModules/PHP_Modules/EncDec.php";
require __DIR__ . "/SysModules/PHP_Modules/UrlActivity.php";
require __DIR__ . "/SysModules/PHP_Modules/GetIPAddress.php";
require __DIR__ . "/SysModules/PHP_Modules/DeviceType.php";
require __DIR__ . "/SysModules/PHP_Modules/DeviceInfo.php";
require __DIR__ . "/SysModules/PHP_Modules/DataActivity.php";
require __DIR__ . "/SysModules/PHP_Modules/DataReturns.php";
require __DIR__ . "/SysModules/PHP_Modules/FormValidations.php";
require __DIR__ . "/SysModules/PHP_Modules/UserProperties.php";
require __DIR__ . "/SysModules/PHP_Modules/DeveloperConstants.php";
require __DIR__ . "/SysModules/PHP_Modules/DirHandler.php";
require __DIR__ . "/SysModules/PHP_Modules/SessionDataHandler.php";

//Some File Handling Functions
require __DIR__ . "/SysModules/FILE_Modules/DocumentDetails.php";
require __DIR__ . "/SysModules/FILE_Modules/GetFilesFromDirectory.php";
require __DIR__ . "/SysModules/FILE_Modules/UploadHandler.php";
require __DIR__ . "/SysModules/FILE_Modules/OtherFunctions.php";

//Form Validation + Message Handling Functions
require __DIR__ . "/SysModules/PROCESS_Modules/FormRequestHandler.php";
require __DIR__ . "/SysModules/PROCESS_Modules/FormRequestValidator.php";
require __DIR__ . "/SysModules/PROCESS_Modules/Handler.php";
require __DIR__ . "/SysModules/PROCESS_Modules/RequestHandler.php";

//CRUD OPERATION Handlers
require __DIR__ . "/SysModules/CRUD_Modules/Select.php";
require __DIR__ . "/SysModules/CRUD_Modules/Checker.php";
require __DIR__ . "/SysModules/CRUD_Modules/Insert.php";
require __DIR__ . "/SysModules/CRUD_Modules/Update.php";
require __DIR__ . "/SysModules/CRUD_Modules/Delete.php";
require __DIR__ . "/SysModules/CRUD_Modules/Suggest.php";
require __DIR__ . "/SysModules/CRUD_Modules/SysValues.php";
require __DIR__ . "/SysModules/CRUD_Modules/DBOperations.php";
require __DIR__ . "/SysModules/CRUD_Modules/CreateTables.php";
require __DIR__ . "/SysModules/CRUD_Modules/Query.php";

//App Configuration 
require __DIR__ . "/SysModules/CONFIG_Modules/Configurations.php";

//HTML Functions + Forms
require __DIR__ . "/SysModules/HTML_Modules/Form.php";
require __DIR__ . "/SysModules/HTML_Modules/HTMLTags.php";
require __DIR__ . "/SysModules/HTML_Modules/HTMLFunctions.php";
require __DIR__ . "/SysModules/HTML_Modules/Calendar.php";

//activity modules
require  __DIR__ . "/SysModules/ACTIVITY_Modules/AppLogsDB.php";

//payment modules
require  __DIR__ . "/SysModules/PAYMENT_Modules/Payments.php";

//complaint modules
require  __DIR__ . "/SysModules/COMPLAINT_Modules/Complaints.php";

//Invoice modules
require  __DIR__ . "/SysModules/INVOICE_Modules/invoices.php";

//leads modules
require  __DIR__ . "/SysModules/LEAD_Modules/Calls.php";
require  __DIR__ . "/SysModules/LEAD_Modules/Leads.php";

//e-commerce modules
require  __DIR__ . "/SysModules/E_COMMERCE_Modules/ProductModules.php";
require  __DIR__ . "/SysModules/E_COMMERCE_Modules/CartModules.php";
require  __DIR__ . "/SysModules/E_COMMERCE_Modules/OrderModules.php";
require  __DIR__ . "/SysModules/E_COMMERCE_Modules/PriceAndCharges.php";

//user modules
require  __DIR__ . "/SysModules/USER_Modules/users.php";

//employement modules
require  __DIR__ . "/SysModules/EMPLOYEMENT_Modules/Attandance.php";
require  __DIR__ . "/SysModules/EMPLOYEMENT_Modules/EmploymentFuns.php";

//enquiry modules
require  __DIR__ . "/SysModules/ENQUIRY_Modules/Enquiries.php";

//expanse modules
require  __DIR__ . "/SysModules/EXPANSE_Modules/Expanse.php";

//mails modules
require  __DIR__ . "/SysModules/MAIL_Modules/Mail.php";

//sms modules
require  __DIR__ . "/SysModules/SMS_Modules/SMS.php";

//warranty modules
require  __DIR__ . "/SysModules/WARRANTY_Modules/warranty.php";

//project modules
require  __DIR__ . "/SysModules/PROJECT_Modules/Projects.php";

//notifcations modules
require __DIR__ . "/SysModules/NOTIFICATIONS_Modules/FloatingNotifications.php";

//All Data collection modules
require __DIR__ . "/SysModules/DATA_COLLECTION_Modules/AllBankLists.php";
require __DIR__ . "/SysModules/DATA_COLLECTION_Modules/AllCountryNames.php";
require __DIR__ . "/SysModules/DATA_COLLECTION_Modules/AllCurrencyTypes.php";
require __DIR__ . "/SysModules/DATA_COLLECTION_Modules/AllIndianStates.php";
require __DIR__ . "/SysModules/DATA_COLLECTION_Modules/CountryPhoneCodes.php";
