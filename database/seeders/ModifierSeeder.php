<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modifier;
use App\Models\ModifierInvalidCombination;

class ModifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modifiers = [
            [
                "modifier" => "21",
                "special_coding_instructions" => "Modifier 21 is no longer valid for use. When the face-to-face or floor/unit service(s) provided is prolonged or otherwise greater than usually required for the highest level of evaluation and management (E&M) service within a given category, it can be identified by adding modifier 21 to the E&M code. This modifier can only be submitted with E&M procedures. Do not use with any other sections of the CPT® codebook.
Modifier 21 is only acceptable to be billed with E&M codes that are NOT time-based codes. The time-based E&M codes would not require modifier 21 because the additional work performed for these codes can sometimes be reflected in other codes for the additional time spent with the patient. For example, codes 99291 and 99292 for critical care are time-based codes. Modifier 21 would not be necessary because 99291 is reported for the first 30 to 74 minutes and 99292 is reported for each additional 30 minutes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "22",
                "special_coding_instructions" => "Modifier 22 can be used on any procedure within the Anesthesia, Surgery, Radiology, Laboratory/Pathology and Medicine series of codes. However, this modifier should not be used on E&M services. E&M codes with a modifier 22 will be denied.
If modifier 22 is used on any surgical procedure, then it must only be used on surgeries which have a global period of 000, 010, 090, or YYY identified on the Medicare Physician Fee Schedule Relative Value File.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "23",
                "special_coding_instructions" => "Modifier 23 can only be submitted with anesthesia CPT® codes 00100 – 01999.
Anesthesiologists, certified registered nurse anesthetists (CRNAs), or anesthesiologist assistants (AAs) should submit this modifier to indicate a procedure which is normally performed under local anesthesia or with a regional block required general anesthesia.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "24",
                "special_coding_instructions" => "This modifier can be used to indicate that an E&M service or eye exam, which falls within the global period of a major or minor surgery and which is performed by the surgeon, is unrelated to the surgery. 
Note: Although the CPT® description of modifier 24 reflects “postoperative,” this modifier can be submitted for a visit performed the day prior to a major surgery when the visit is unrelated to the surgery.
This modifier can only be submitted with E&M and eye exam codes.
Documentation in the patient's medical record must support the use of this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "25",
                "special_coding_instructions" => "This modifier can be used to indicate that an E&M service or eye exam, which is performed on the same day as a minor surgery (000 or 010 global days) and which is performed by the surgeon, is significant and separately identifiable from the usual work associated with the surgery. This modifier can only be submitted with E&M codes.
Documentation in the patient's medical record must support the use of this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "26",
                "special_coding_instructions" => "If billing for the global component (professional & technical) of a procedure, modifiers 26 and TC should not be used.
Modifier 26 can only be used by professional providers. It should not be used by a hospital.
KMAP uses the Medicare Physician Fee Schedule Relative Value file to determine which procedures are appropriately billed with modifier 26.
KMAP uses the PT/TC indicator field on the file as a basis to determine proper usage of modifier 26. The following determination has been made based on the individual indicators.
This modifier should not be used on procedures which have a PC/TC indicator equal to 0, 2, 3, 4, 5, 8, and 9 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid that has been assigned one of these indicators will be denied unless Medicaid has instructed differently through provider bulletins and/or manuals.
Complete definitions of the PC/TC indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).",
                "invalid_combinations" => ["50", "62", "66", "TC"]
            ],
            [
                "modifier" => "27",
                "special_coding_instructions" => "Modifier 27 is used to identify multiple outpatient hospital E&M encounters on the same date. This modifier is not to be used by physician practices. It was created exclusively for hospital outpatient departments.
For hospital outpatient reporting purposes, utilization of hospital resources related to separate and distinct E&M encounters performed in multiple outpatient hospital settings on the same date can be reported by adding modifier 27 to each appropriate level outpatient and/or emergency department E&M code(s).
This modifier cannot be used for physician reporting of multiple E&M services performed by the same physician on the same date. This modifier is valid for the following CPT® code ranges: 99201 – 99239, 99241 – 99255, 99281 – 99299",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "32",
                "special_coding_instructions" => "Modifier 32 is no longer valid for Early Periodic Screening Diagnosis and Treatment (EPSDT) services. Use modifier EP where modifier 32 was previously used. Claims billed with modifier 32 will be denied.
For further billing/coding instructions, refer to the KAN Be Healthy Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "47",
                "special_coding_instructions" => "This modifier should be appended only to the surgical procedure code when applicable. It is not appropriate to use this modifier on anesthesia procedure codes.
The anesthesiologist would not use this modifier.
Do not report modifier 47 when the physician reports moderate (conscious) sedation",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "50",
                "special_coding_instructions" => "KMAP uses the Medicare Physician Fee Schedule Relative Value file to determine which procedures are appropriately billed with modifier 50.
KMAP uses the Bilat Surg indicator field on the file as a basis to determine proper usage of modifier 50. The following determinations have been made based on the individual indicators.
This modifier should not be used on procedures which have a Bilat Surg indicator equal to 0, 2, 3 and 9 on the Medicare Physician Fee Schedule Relative Value file.
Any procedure billed to Medicaid that has been assigned one of these indicators will be denied unless Medicaid has instructed differently through provider bulletins and/or manuals.
This modifier should only be used on procedures which have a Bilat Surg indicator equal to 1 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid that has been assigned this indicator will continue to be processed as normal.
Complete definitions of the Bilat Surg indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).
When a procedure is identified as one that can have modifier 50 added to the base code when performed bilaterally, bill the procedure code as a single line item on the claim form with modifier 50 and units of service equal to one. For example, a bilateral tympanostomy must be billed indicating code 69436 50 as one unit.
When a code states ‘unilateral’ or ‘bilateral’ in the description, do not add modifier 50. In this instance, the base code is billed only once on the claim and the number of units is one.
For example, code 58900 is equal to one unit.
Physicians who perform facet joint injections on both the right and left sides of one level of the spine must use modifier 50 with the appropriate CPT® codes when submitting claims.
Physicians who perform facet joint injections on multiple levels on the same side of the spine must use the CPT® add-on codes to represent these additional levels injected, instead of using modifier 50. Facet Joint Injection CPT® codes are 64470, 64472 (add-on code), 64475, 64476 (add-on code).
Modifier 50 is a processing modifier, and the rate is 150% of the base code.",
                "invalid_combinations" => ["26", "LT", "RT", "TC"]
            ],
            [
                "modifier" => "51",
                "special_coding_instructions" => "KMAP uses the Medicare Physician Fee Schedule Relative Value file to determine which procedures are appropriately billed with modifier 51.
KMAP uses the Mult Proc indicator field on the file as a basis to determine proper usage of modifier 51. The following determinations have been made based on the individual indicators.
This modifier should not be used on procedures which have a Mult Proc indicator equal to 0 and 9 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid that has been assigned one of these indicators will be denied unless Medicaid has instructed differently through bulletins and/or provider manuals.
This modifier should only be used on procedures which have a Mult Proc indicator equal to 1, 2, 3 and 4 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid that has been assigned any of these indicators will continue to be processed as normal.
Complete definitions of the Mult Proc indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).
This modifier cannot be submitted with designated add-on codes (refer to the CPT® codebook for a list of add-on codes). Also, any code with a Glob Surg indicator equal to ZZZ on the Medicare Physician Fee Schedule Relative Value file is considered an add-on code.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "52",
                "special_coding_instructions" => "Under certain circumstances, a service or procedure is partially reduced or eliminated at the physician’s discretion. Under these circumstances, the service provided can be identified by its usual procedure number and the addition of modifier 52, signifying that the service is reduced.
KMAP does not recognize modifier 52 when used on E&M codes if supporting documentation is not submitted to support its use.
Do not use this modifier if the procedure is discontinued after administration of anesthesia (use modifier 53).",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "53",
                "special_coding_instructions" => "Under certain circumstances, the physician can elect to terminate a surgical or diagnostic procedure. Due to extenuating circumstances or those that threaten the well being of the patient, it may be necessary to indicate that a surgical or diagnostic procedure was started but discontinued. This circumstance can be reported by adding modifier 53 to the code reported by the physician for the discontinued procedure.
Modifier 53 should not be used on E&M codes. It is only valid for surgical and medical diagnostic codes when the procedure was started but had to be discontinued because of extenuating circumstances.
KMAP denies E&M codes when billed with modifier 53.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "54",
                "special_coding_instructions" => "When one physician performs a surgical procedure and another provides preoperative and/or
postoperative management, surgical codes can be identified by adding the modifier 54.
Physicians who perform the surgery and furnish all of the usual pre- and post-operative work
bill for the global package by entering the appropriate CPT® code for the surgical procedure only; therefore, modifiers 54 and 55 cannot be combined on a single detail line item.
KMAP uses the Medicare Physician Fee Schedule Relative Value file to determine which procedures are appropriately billed with modifier 54.
KMAP uses the Glob Days field on the file as a basis to determine proper usage of modifier 54. The following determinations have been made based on the individual indicators.
This modifier cannot be used on procedures unless the Glob Days field is equal to 010 or 090 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid with modifier 54 and global surgery days other than 010 and 090 will be denied unless Medicaid has instructed differently through provider bulletins and/or manuals.
This modifier can only be used on procedures which have a Glob Days field equal to 010 or 090 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid and assigned global surgery days equal to 010 or 090 will process as normal.
Complete definitions of the Glob Days indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).",
                "invalid_combinations" => ["55", "56", "80", "81", "82", "AS"]
            ],
            [
                "modifier" => "55",
                "special_coding_instructions" => "When one physician performs the postoperative management and another physician performs the surgical procedure, the postoperative component can be identified by adding modifier 55 to the code. Physicians who perform the surgery and furnish all of the usual pre- and post-operative work bill for the global package by entering the appropriate CPT® code for the surgical procedure only; therefore, modifiers 54 and 55 cannot be combined on a single detail line item. KMAP uses the Medicare Physician Fee Schedule Relative Value file to determine which procedures are appropriately billed with modifier 55. KMAP uses the Glob Days field on the file as a basis to determine proper usage of modifier 55. The following determinations have been made based on the individual indicators.
This modifier cannot be used on procedures unless the Glob Days field is equal to 010 or 090 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid with modifier 55 and global surgery days other than 010 and 090 will be denied unless Medicaid has instructed differently through provider bulletins and/or manuals.
This modifier can only be used on procedures which have a Glob Days field equal to 010 or 090 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid that has been assigned global surgery days equal to
010 or 090 will process as normal.
Complete definitions of the Glob Days indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).",
                "invalid_combinations" => ["54", "56", "78", "80", "81", "82", "AS"]
            ],
            [
                "modifier" => "56",
                "special_coding_instructions" => "When one physician performs the preoperative care and evaluation and another physician performs the surgical procedure, preoperative component can be identified by adding modifier 56 to the code. Physicians who perform the surgery and furnish all of the usual preand post-operative work bill for the global package by entering the appropriate CPT® code for the surgical procedure only.
KMAP uses the Medicare Physician Fee Schedule Relative Value file to determine which procedures are appropriately billed with modifier 56.
KMAP uses the Glob Days field on the file as a basis to determine proper usage of modifier 56. The following determinations have been made based on the individual indicators.
This modifier cannot be used on procedures unless the Glob Days field is equal to 010 or 090 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid with modifier 56 and global surgery days other than 010 and 090 will be denied unless Medicaid has instructed differently through provider bulletins and/or manuals.
This modifier can only be used on procedures which have a Glob Days field equal to 010 or 090 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid that has been assigned global surgery days equal to 010 or 090 will process as normal.
Complete definitions of the Glob Days indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "57",
                "special_coding_instructions" => "Modifier 57 indicates an E&M service resulted in the initial decision to perform surgery either the day before a major surgery (90-day global period) or the day of a major surgery (90-day global period). Modifier 57 can only be used on E&M codes.
KMAP denies services billed with modifier 57 on codes other than E&M codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "58",
                "special_coding_instructions" => "It may be necessary to indicate the performance of a procedure or service during the postoperative period was (a) planned or anticipated (staged); (b) more extensive than the original procedure; or (c) for therapy following a surgical procedure. Complications from surgery which do not require a return trip to the operating room are considered part of the global surgery package from the original surgery and are not payable separately. Modifier 58 is not appropriate in this situation.
Note: For treatment of a problem that requires a return to the operating or procedure room (e.g., unanticipated clinical condition), see modifier 78.
Modifier 58 cannot be appended to ambulatory surgical center (ASC) facility fee claims.
Modifier 58 cannot be appended to a procedure with “XXX” in the Glob Days field on the Medicare Physician Fee Schedule Relative Value File. Complete definitions of the Glob Days indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).",
                "invalid_combinations" => ["80", "81", "82", "AS"]
            ],
            [
                "modifier" => "59",
                "special_coding_instructions" => "Modifier 59 can be used for a different session, different procedure or surgery, different site or organ system, separate incision or excision, separate lesion, or separate injury.
The following example illustrates the appropriate usage of this modifier: A patient with a leg wound comes in for a culture of the site of the wound. The lab tech obtains independent specimens per the order, one from the proximal wound site and one from the distal wound site. This is coded as follows: 87071 (for the proximal site) and 87071 59 (for the distal site).
Modifier 59 is appropriately appended to the second code to identify it was a different site from the first specimen. Modifier 59 cannot be used on E&M service codes or on code 77427. KMAP denies E&M codes and code 77427 when billed with modifier 59.
Documentation must be submitted with the claim which supports that a different session or patient encounter, different procedure or surgery, different site or organ system, separate incision or excision, separate lesion, or separate injury (or area of injury in extensive injuries) not ordinarily encountered or performed on the same day by the same physician.",
                "invalid_combinations" => ["76"]
            ],
            [
                "modifier" => "62",
                "special_coding_instructions" => "When two surgeons work together as primary surgeons performing distinct part(s) of a procedure, each surgeon must report his or her distinct operative work by adding modifier 62 to the procedure code and any associated add-on codes for that procedure as long as both surgeons continue to work together as primary surgeons. Each surgeon should report the co-surgery once using the same procedure code. If additional procedure(s) including add-on procedure(s) are performed during the same surgical session, separate code(s) can also be reported with modifier 62 added.
Note: If a co-surgeon acts as an assistant in the performance of additional procedure(s) during the same surgical session, those services can be reported using separate procedure code(s) with modifier 80 or modifier 82 added, as appropriate.",
                "invalid_combinations" => ["26", "66", "80", "81", "82", "AS", "TC"]
            ],
            [
                "modifier" => "63",
                "special_coding_instructions" => "Procedures performed on neonates and infants up to a present body weight of four kg may involve significantly increased complexity and physician work commonly associated with these patients. This circumstance can be reported by adding modifier 63 to the procedure code. Modifier 63 can only be appended to procedures/services listed in the 20000 – 69990 code series of the CPT® codebook.
Modifier 63 cannot be appended to any codes listed in the E&M, Anesthesia, Radiology, Pathology/Laboratory, or Medicine series of codes in the CPT® codebook.
The CPT® codebook lists codes for which modifier 63 cannot be reported. 
KMAP denies codes other than 20000 – 69990 when billed with modifier 63.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "66",
                "special_coding_instructions" => "Under some circumstances, highly complex procedures (requiring the concomitant services of several physicians, often of different specialties, plus other highly skilled, specially trained personnel, various types of complex equipment) are carried out under the “surgical team” concept. Such circumstances can be identified by each participating physician with the addition of modifier 66 to the basic procedure code used for reporting services.",
                "invalid_combinations" => ["26", "62", "80", "81", "82", "AS", "TC"]
            ],
            [
                "modifier" => "73",
                "special_coding_instructions" => "Submit modifier 73 for ASC facility charges when the surgical procedure is discontinued before anesthesia is administered. This modifier cannot be submitted by the operating surgeon. Only ASCs can submit this modifier. Surgeons can refer to modifier 53.
Modifier 73 is used by the facility to indicate a surgical or diagnostic procedure requiring anesthesia was terminated due to extenuating circumstances or to circumstances that threatened the well being of the patient after the patient had been prepared for the procedure (including procedural premedication when provided) and taken to the room where the procedure was to be performed but prior to administration of anesthesia.
This modifier code was created so the costs incurred by the hospital to prepare the patient for the procedure and the resources expended in the procedure room and recovery room (if needed) can be recognized for payment even though the procedure was discontinued.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "74",
                "special_coding_instructions" => "Submit modifier 74 for ASC facility charges when the surgical procedure is discontinued after anesthesia is administered. This modifier cannot be submitted by the operating surgeon.
Only ASCs can submit this modifier. Surgeons can refer to modifier 53.
Due to extenuating circumstances or those that threaten the well being of the patient, the physician may terminate a surgical or diagnostic procedure after the administration of anesthesia (local, regional block or general) or after the procedure was started (incision made, intubation started, scope inserted, etc.). Under these circumstances, the procedure started but terminated can be reported by its usual procedure number and the addition of modifier 74. For a physician reporting a discontinued procedure, see modifier 53.
This modifier was created so the costs incurred by the hospital to initiate the procedure (preparation of the patient, procedure room, recovery room) can be recognized for payment even though the procedure was discontinued prior to completion.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "76",
                "special_coding_instructions" => "When a diagnostic procedure is performed during separate patient encounters (such as, different times of the day), the second code can be reported with modifier 76. Do not use modifier 76 when the definition of the code indicates a repeated procedure or redo (such as 57511).
Modifier 76 is used when the procedure is repeated by the same physician subsequent to the original service. The repeat service must be identical to the initial service provided.
This modifier is separate and distinct from modifiers 58, 78, and 79. Please refer to details for these modifiers.
If the same procedures are performed on the same day, they must be billed on the same claim. If the duplicative service is not billed on the same claim, a duplicate denial of the service will occur.
Although valid, this modifier does not document payable services during the global period, therefore rendering this modifier invalid for use with a surgical code. Repeat procedures for treatment of complications can be billed with modifier 78.
Repeat procedures for Clinical Diagnostic Laboratory codes can be billed with modifier 91 not 76. The Medicare Clinical Diagnostic Laboratory Fee Schedule from the CMS website is used to determine which procedures are considered to be Clinical Diagnostic Lab procedures. KMAP denies surgical and clinical diagnostic laboratory codes when billed with modifier 76.",
                "invalid_combinations" => ["59", "77"]
            ],
            [
                "modifier" => "77",
                "special_coding_instructions" => "Modifier 77 is used when a procedure is repeated by a different physician subsequent to the original service; the repeat service must be identical to the initial service provided.
Use modifier 77 to report the same procedure performed more than once on the same date of service but at different encounters. Repeat procedures for clinical diagnostic laboratory codes can be billed with modifier 91 instead of modifier 77.
KMAP denies clinical diagnostic laboratory codes when billed with modifier 77. The Medicare Clinical Diagnostic Laboratory Fee Schedule from the CMS website is used to determine which procedures are considered to be Clinical Diagnostic Lab procedures.
Modifier 77 cannot be used with E&M services 92002 – 92014 and 99201 – 99499.
KMAP will deny all E&M services submitted with modifier 77. If denied, physicians must remove the modifier and resubmit the claim. For rules regarding where multiple physicians in the same group with the same specialty are performing E&M services on the same day for the same patient, refer to Wisconsin Physicians Service (WPS) website at:
http://www.wpsmedicare.com/part_b/education/evalmngmnt.shtml.",
                "invalid_combinations" => ["76"]
            ],
            [
                "modifier" => "78",
                "special_coding_instructions" => "KMAP uses the Medicare Physician Fee Schedule Relative Value file from the CMS website to determine which procedures are appropriately billed with modifiers 78 and 79.
KMAP uses the Glob Days field on the file as a basis to determine proper usage of modifiers 78 and 79. The following determinations have been made based on the individual days assigned. These modifiers can only be used on surgical procedures with global days equal to 000, 010, 090, MMM, YYY, or ZZZ on the Medicare Physician Fee Schedule Relative Value file. Any surgical procedure billed to Medicaid with modifier 78 or 79 that does not have global days of 000, 010, 090, MMM, YYY, or ZZZ will be denied.
Complete definitions of the Glob Days indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).",
                "invalid_combinations" => ["80", "81", "82", "AS"]
            ],
            [
                "modifier" => "79",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "80",
                "special_coding_instructions" => "Surgical assistant services can be identified by adding modifier 80 to the usual procedure code. Use modifier 80 when the assistant at surgery service is provided by a medical doctor (MD). Modifier 80 can only be used by professional providers. It should not be used by a hospital. This modifier can only be submitted with surgery codes.
Physician assistants, nurse practitioners and clinical nurse specialists cannot submit this modifier. See modifier AS.
Modifier 80 is a processing modifier, and the rate is 25% of the base code.",
                "invalid_combinations" => ["54", "55", "58", "62", "66", "78", "79"]
            ],
            [
                "modifier" => "81",
                "special_coding_instructions" => "Although a primary operating physician may plan to perform a surgical procedure alone, during the operation circumstances can arise requiring the services of an assistant surgeon for a relatively short time. In this instance, the second surgeon provides minimal assistance, for which he or she reports the surgical procedure code with modifier 81.
Modifier 81 can only be used by professional providers. It should not be used by a hospital.
This modifier can only be submitted with surgery codes. Physician assistants, nurse practitioners, and clinical nurse specialists must not submit this modifier. See modifier AS.
Modifier 81 is a processing modifier, and the rate is 25% of the base code.",
                "invalid_combinations" => ["54", "55", "58", "62", "66", "78", "79"]
            ],
            [
                "modifier" => "82",
                "special_coding_instructions" => "The prerequisite for using modifier 82 is the unavailability of a qualified resident surgeon. In certain programs (such as teaching hospitals), the physician acting as the assistant surgeon is usually a qualified resident surgeon. However, there are times (such as during rotational change) when a qualified resident surgeon is not available and another surgeon assists in the operation. In these instances, the services of the nonresident assistant surgeon are reported with modifier 82. Use modifier 82 when the assistant at surgery service is provided by an MD when there is not a qualified resident available. Documentation must include information relating to the unavailability of a qualified resident in this situation.
Modifier 82 can only be used by professional providers. It should not be used by a hospital.
This modifier can only be submitted with surgery codes.
Physician assistants, nurse practitioners and clinical nurse specialists must not submit this modifier. See modifier AS.
Modifier 82 is a processing modifier, and the rate is 25% of the base code.",
                "invalid_combinations" => ["54", "55", "58", "62", "66", "78", "79"]
            ],
            [
                "modifier" => "90",
                "special_coding_instructions" => "The American Medical Association (AMA) developed modifier 90 for use by a physician or clinic when laboratory tests for a patient are performed by an outside or reference laboratory.
Although the physician is reporting the performance of a laboratory test, this modifier is used to indicate the actual testing component was provided by a laboratory.
When the physician bills the patient for laboratory work performed by an outside or (reference) laboratory, modifier 90 is added to the laboratory procedure code. Physicians use this modifier when laboratory procedures are performed by a party other than the treating or reporting physician.
Modifier 90, when appropriate, should only be used on procedure codes 80000 – 89999.
KMAP will deny services billed with modifier 90 on any codes other than 80000 – 89999.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "91",
                "special_coding_instructions" => "During the course of patient treatment, it may be necessary to repeat the same laboratory test on the same day to obtain subsequent (multiple) test results. Under these circumstances, the laboratory test performed can be identified by the addition of modifier 91.
Modifier 91 is used to identify a lab test performed more than once on the same day for the same patient when multiple results are necessary for proper treatment.
For example, a patient with diabetic ketoacidosis has multiple blood tests performed to check potassium level after potassium replacement and low-dose insulin therapy. After the initial potassium value is measured, three subsequent blood tests are ordered and performed on the same date after the administration of potassium to correct the patient's hypokalemic state. This is coded as follows: 84132 (initial test), 84132-91, 84132-91, 84132-91.
KMAP uses the Medicare Clinical Diagnostic Laboratory Fee Schedule (CDLFS) from the CMS website as the basis for determining proper usage of modifier 91.
Modifier 91 can only be used on Clinical Diagnostic Laboratory procedure codes.
KMAP will deny services billed with modifier 91 for codes other than those identified on the Medicare Clinical Diagnostic Laboratory Fee Schedule.",
                "invalid_combinations" => ["76", "77"]
            ],
            [
                "modifier" => "92",
                "special_coding_instructions" => "When laboratory testing is being performed using a kit or transportable instrument that wholly or in part consists of a single use, disposable analytical chamber, the service can be identified by adding modifier 92 to the usual laboratory procedure code (HIV testing 86701, 86702, and 86703). KMAP will deny services billed with modifier 92 for codes other than 86701, 86702, and 86703.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "99",
                "special_coding_instructions" => "This modifier is reportable on all procedure codes. This modifier must not be used when reporting less than five modifiers for a single detail line of service.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A1",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A2",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A3",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A4",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A5",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A6",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A7",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A8",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "A9",
                "special_coding_instructions" => "Modifiers A1 through A9 indicate a particular item is being used as a primary or secondary dressing on a surgical or debrided wound and also indicate the number of wounds on which that dressing is being used. The modifier number must correspond to the number of wounds on which the dressing is being used, not the total number of wounds treated.
Modifiers A1 through A9 are used for informational purposes and are not required.
However, if you choose to bill with these modifiers, they should only be used on the following codes: A4550 – A4649, A6010 – A6512, and A9270. KMAP denies services billed with modifiers A1 through A9 on codes other than those identified previously. For further information, refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AA",
                "special_coding_instructions" => "These modifiers can only be submitted with anesthesia procedure codes (such as codes 00100 – 01999). KMAP denies services billed with modifier AA or AD on codes other than the anesthesia series of codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AD",
                "special_coding_instructions" => "These modifiers can only be submitted with anesthesia procedure codes (such as codes 00100 – 01999). KMAP denies services billed with modifier AA or AD on codes other than the anesthesia series of codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AE",
                "special_coding_instructions" => "This modifier can be submitted with claims for Medical Nutrition Therapy (MNT) and Diabetes Self-Management Training (DSMT).
HCPCS codes: G0108 – G0109 and G0270 – G0271
CPT® codes: 97802 – 97804",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AF",
                "special_coding_instructions" => "These modifiers can be submitted with all HCPCS and CPT® codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AG",
                "special_coding_instructions" => "These modifiers can be submitted with all HCPCS and CPT® codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AH",
                "special_coding_instructions" => "Submit this modifier with diagnostic psychological tests and therapeutic psychotherapy performed by a clinical psychologist.
This modifier can be submitted with the following procedure codes.
CPT® codes: 90801 – 90820, 90821 – 90828, 90830 – 90899, 95880 – 95883, 96100 – 96103, and 96105 – 96120
HCPCS codes: G0071, G0073, G0075, G0077, G0079, G0081, G0083, G0085, G0087, G0089, G0091, G0093, and H5010 – H5030",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AI",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AJ",
                "special_coding_instructions" => "Submit this modifier with diagnostic psychological tests and therapeutic psychotherapy performed by a clinical social worker.
This modifier can be submitted with the following procedure codes.
CPT® codes: 90801 – 90828, 90841 – 90857, and 90875 – 90876
HCPCS codes: G0071, G0073, G0075, G0077, G0079, G0081, G0083, G0085, G0087, G0089, G0091, G0093, and H5010 – H5030",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AK",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AM",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AP",
                "special_coding_instructions" => "This modifier can be submitted with CPT® codes 92002, 92004, 92012, and 92014.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AQ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AR",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AS",
                "special_coding_instructions" => "Use modifier AS for assistant at surgery services provided by: physician assistant (PA), nurse practitioner (NP), and clinical nurse specialist (CNS). Modifier AS can only be used by the professional providers identified previously. It should not be used by a hospital.
Modifier AS is a processing modifier and the rate is 25% of the base code.",
                "invalid_combinations" => ["54", "55", "58", "62", "66", "78", "79"]
            ],
            [
                "modifier" => "AT",
                "special_coding_instructions" => "This modifier can only be used on CPT® codes 98940, 98941, and 98942. KMAP denies services billed with modifier AT on codes other than 98940, 98941, and 98942.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AV",
                "special_coding_instructions" => "KMAP uses the Medicare Durable Medical Equipment, Prosthetics/Orthotics & Supplies Fee Schedule from the CMS website to determine which procedures are appropriately billed with modifiers AV and AW. Procedure codes allowed to be billed with modifier AV or AW will appear on the file with modifier AV or AW (such as A4450 AV or A4450 AW).
KMAP will deny any procedure billed to Medicaid that includes modifier AV or AW and is not found on this file.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AX",
                "special_coding_instructions" => "This modifier should be used on services furnished in conjunction with dialysis services.
KMAP has determined the following list of service codes is appropriate for use with modifier AX.
Dialysis Supplies Billed with Modifier AX
A4215, A4216, A4217, A4244, A4245, A4246, A4247, A4248, A4450, A4452, A4651, A4652, A4657, A4660, A4663, A4670, A4927, A4928, A4930, A4931, A6216, A6250, A6260, A6402
Dialysis Equipment Billed With Modifier AX
E0210, E1632, E1637, E1639
KMAP denies services billed with modifier AX except the codes identified previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AY",
                "special_coding_instructions" => "This modifier was developed for Medicare purposes. Medicare uses this modifier as an end stage renal disease (ESRD) consolidated billing requirement for services included in the ESRD facility bundled payment. At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "AZ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "BA",
                "special_coding_instructions" => "The local policy E2006-065 (Coverage of Enteral and Parenteral Supplies) established the requirement for use of modifier BA. In accordance with this policy, modifier BA must be used for items being supplied in conjunction with total parenteral nutrition (TPN). For parenteral supplies, add modifier BA to the base code (XXXXX-BA) and place in field 24D when billing for items and supplies in conjunction with TPN.
For further billing/coding instructions, refer to the Home Health Agency Provider Manual and Durable Medical Equipment Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "BL",
                "special_coding_instructions" => "This modifier was developed for Medicare purposes. Medicare uses this modifier for hospitals when an Outpatient Prospective Payment System (OPPS) provider purchases blood or blood products from a community blood bank or when an OPPS provider assesses a charge for blood or blood products collected in its own blood bank that reflects more than blood processing and storage.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "BO",
                "special_coding_instructions" => "The local policy E2006-065 (Coverage of Enteral and Parenteral Supplies) established the requirement for use of modifier BO. In accordance with this policy, modifier BO must be used for oral supplemental nutrition in KAN Be Healthy (KBH)-eligible beneficiaries.
For enteral supplies, add modifier BO to the base code (XXXXX-BO) and place in field 24D when billing for oral supplemental nutrition.
For further billing/coding instructions, refer to the Home Health Agency Provider Manual and Durable Medical Equipment Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "BP",
                "special_coding_instructions" => "For further information related to the usage of modifier BP, refer to Durable Medical Equipment Bulletin 9102c from November 2009.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "BR",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "BU",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CA",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CB",
                "special_coding_instructions" => "This modifier was developed for Medicare payment purposes.
Medicare Usage
Service ordered by a renal dialysis facility (RDF) physician as part of the ESRD beneficiary's dialysis benefit is not part of the composite rate and is separately reimbursable.
Guidelines/Instructions
Submit this modifier only when it has been determined that ALL of the following apply:
The patient is entitled to Medicare based on ESRD.
The test is related to the dialysis treatment for ESRD.
The test was ordered by a doctor providing care to patients in the dialysis facility.
The test is not included in the dialysis facility's composite rate payment.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CC",
                "special_coding_instructions" => "This modifier is not to be used by the provider community. It is an internal modifier identifying when the carrier changes the procedure code submitted.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CD",
                "special_coding_instructions" => "These modifiers were developed for Medicare purposes. Medicare uses these modifiers as pricing modifiers to identify the different payment situations for ESRD Automated Multi-Channel Chemistry (AMCC) services. The ESRD clinical diagnostic laboratory tests identified with modifier CD, CE, or CF cannot be billed as organ or disease panels.
However, KMAP has determined it would be appropriate for modifiers CD, CE, and CF to be used only on the following codes:
82040, 82247, 82248, 82310, 82330, 82374, 82435, 82465, 82550, 82565, 82947, 82977, 83615, 84075, 84100, 84132, 84155, 84295, 84450, 84460, 84478, 84520, 84550
If these modifiers are billed to Medicaid on codes other than the ones listed previously, the service will be denied.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CE",
                "special_coding_instructions" => "These modifiers were developed for Medicare purposes. Medicare uses these modifiers as pricing modifiers to identify the different payment situations for ESRD Automated Multi-Channel Chemistry (AMCC) services. The ESRD clinical diagnostic laboratory tests identified with modifier CD, CE, or CF cannot be billed as organ or disease panels.
However, KMAP has determined it would be appropriate for modifiers CD, CE, and CF to be used only on the following codes:
82040, 82247, 82248, 82310, 82330, 82374, 82435, 82465, 82550, 82565, 82947, 82977, 83615, 84075, 84100, 84132, 84155, 84295, 84450, 84460, 84478, 84520, 84550
If these modifiers are billed to Medicaid on codes other than the ones listed previously, the service will be denied.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CF",
                "special_coding_instructions" => "These modifiers were developed for Medicare purposes. Medicare uses these modifiers as pricing modifiers to identify the different payment situations for ESRD Automated Multi-Channel Chemistry (AMCC) services. The ESRD clinical diagnostic laboratory tests identified with modifier CD, CE, or CF cannot be billed as organ or disease panels.
However, KMAP has determined it would be appropriate for modifiers CD, CE, and CF to be used only on the following codes:
82040, 82247, 82248, 82310, 82330, 82374, 82435, 82465, 82550, 82565, 82947, 82977, 83615, 84075, 84100, 84132, 84155, 84295, 84450, 84460, 84478, 84520, 84550
If these modifiers are billed to Medicaid on codes other than the ones listed previously, the service will be denied.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CG",
                "special_coding_instructions" => "This modifier can be submitted with all HCPCS and CPT® codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CR",
                "special_coding_instructions" => "HCPCS modifier CR is used by Medicare to track and facilitate claims processing for disaster victims. This modifier can only be submitted with services that are related to a disaster or catastrophe, such as Hurricane Katrina in 2005.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "CS",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "DA",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "DH",
                "special_coding_instructions" => "This modifier is used on claims for ambulance services.
Modifiers which are used on claims for ambulance services are created by combining two alpha characters. Each alpha character, with the exception of X, represents an origin (source) code or a destination code. The pair of alpha codes creates one modifier. The first position alpha code equals origin; the second position alpha code equals destination.
Origin and destination codes are the following: D, E, G, H, I, J, N, P, R, S and X.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "DN",
                "special_coding_instructions" => "This modifier is used on claims for ambulance services.
Modifiers which are used on claims for ambulance services are created by combining two alpha characters. Each alpha character, with the exception of X, represents an origin (source) code or a destination code. The pair of alpha codes creates one modifier. The first position alpha code equals origin; the second position alpha code equals destination.
Origin and destination codes are the following: D, E, G, H, I, J, N, P, R, S and X.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "E1",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers. These modifiers are for surgical and diagnostic services. These modifiers are not for E&M services.
When eyelid procedures are coded, instead of modifier RT or LT, the procedure code must be appended with modifiers E1 through E4 to indicate upper and lower eyelid.
For example: Same Claim – Detail Line Item 1: 67916 E1; Detail Line Item 2: 67916 E3",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "E2",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers. These modifiers are for surgical and diagnostic services. These modifiers are not for E&M services.
When eyelid procedures are coded, instead of modifier RT or LT, the procedure code must be appended with modifiers E1 through E4 to indicate upper and lower eyelid.
For example: Same Claim – Detail Line Item 1: 67916 E1; Detail Line Item 2: 67916 E3",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "E3",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers. These modifiers are for surgical and diagnostic services. These modifiers are not for E&M services.
When eyelid procedures are coded, instead of modifier RT or LT, the procedure code must be appended with modifiers E1 through E4 to indicate upper and lower eyelid.
For example: Same Claim – Detail Line Item 1: 67916 E1; Detail Line Item 2: 67916 E3",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "E4",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers. These modifiers are for surgical and diagnostic services. These modifiers are not for E&M services.
When eyelid procedures are coded, instead of modifier RT or LT, the procedure code must be appended with modifiers E1 through E4 to indicate upper and lower eyelid.
For example: Same Claim – Detail Line Item 1: 67916 E1; Detail Line Item 2: 67916 E3",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EA",
                "special_coding_instructions" => "CMS uses these modifiers to gather information to determine the prevalence and severity of anemia associated with cancer therapy, the clinical and hematologic responses to the institution of antianemia therapy, and the outcomes associated with various doses of antianemia therapy.
If these modifiers are used, they are only valid when submitted with the following HCPCS codes on non-ESRD claims for ESAs:
J0881, J0882, J0885, J0886 and Q4081",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EB",
                "special_coding_instructions" => "CMS uses these modifiers to gather information to determine the prevalence and severity of anemia associated with cancer therapy, the clinical and hematologic responses to the institution of antianemia therapy, and the outcomes associated with various doses of antianemia therapy.
If these modifiers are used, they are only valid when submitted with the following HCPCS codes on non-ESRD claims for ESAs:
J0881, J0882, J0885, J0886 and Q4081",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EC",
                "special_coding_instructions" => "CMS uses these modifiers to gather information to determine the prevalence and severity of anemia associated with cancer therapy, the clinical and hematologic responses to the institution of antianemia therapy, and the outcomes associated with various doses of antianemia therapy.
If these modifiers are used, they are only valid when submitted with the following HCPCS codes on non-ESRD claims for ESAs:
J0881, J0882, J0885, J0886 and Q4081",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "ED",
                "special_coding_instructions" => "CMS uses this modifier for national claims monitoring for ESAs administered to ESRD patients receiving dialysis in a renal dialysis facility.
Submit this modifier when the following criteria are met:
The ESA is administered to an ESRD patient receiving dialysis in a renal dialysis facility.
The patient's hematocrit level has exceeded 39.0% (or hemoglobin level has exceeded 13.0g/dl) for three or more consecutive billing cycles immediately prior to and including the current billing cycle.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EE",
                "special_coding_instructions" => "CMS uses this modifier for national claims monitoring for ESAs administered to ESRD patients receiving dialysis in a renal dialysis facility.
Submit this modifier when the following criteria are met:
The ESA is administered to an ESRD patient receiving dialysis in a renal dialysis facility.
The patient's hematocrit level has exceeded 39.0% (or hemoglobin level has exceeded 13.0g/dl) for three or more consecutive billing cycles immediately prior to and including the current billing cycle.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EH",
                "special_coding_instructions" => "This modifier is used on claims for ambulance services. Modifiers which are used on claims for ambulance services are created by combining two alpha characters.
Each alpha character, with the exception of X, represents an origin (source) code or a destination code. The pair of alpha codes creates one modifier. The first position alpha code equals origin; the second position alpha code equals destination. Origin and destination codes are the following: D, E, G, H, I, J, N, P, R, S, and X.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EJ",
                "special_coding_instructions" => "This modifier is purely informational and can be submitted with many HCPCS J-codes for injections",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EM",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EP",
                "special_coding_instructions" => "Modifier EP is to be used for EPSDT services where modifier 32 was previously used.
Modifier 32 is no longer valid for EPSDT services. CMS no longer recognizes CPT® codes 99201, 99211, and 99212 as qualifying EPSDT screens. These codes are no longer valid for EPSDT screens and should not be billed with modifier EP.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "ET",
                "special_coding_instructions" => "Modifier ET must be added to the base E&M procedure code when billing the hospital for emergency room/observation room and supplies. KMAP has determined the following set of codes are the only codes that can be billed with modifier ET: 99070, 99218, 99281, 99282, 99283, 99284, 99285, 99291, and 99292.
When billing for the hospital-based physician, indicate the base code only (no modifier).
For further billing/coding instructions, refer to the Hospital Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "EY",
                "special_coding_instructions" => "CMS instituted modifier EY to allow DME suppliers to submit claims to Medicare for items without a prescription. Since there is not physician or provider information to report on claims for these items, modifier EY is used in conjunction with a surrogate unique physician identification number (UPIN) in the ordering/referring provider name fields of the claim.
This protocol was adopted so that suppliers could obtain a Medicare denial which could be sent to a secondary insurer for coordination of benefit (COB) purposes. Services and supplies billed to KMAP with modifier EY will be denied. KMAP will not reimburse for services or supplies not ordered by a licensed health care provider.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F1",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F2",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F3",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F4",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F5",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F6",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F7",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F8",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "F9",
                "special_coding_instructions" => "These modifiers are anatomic-specific modifiers and are appropriate for surgical and diagnostic services. These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "FA",
                "special_coding_instructions" => "This modifier is an anatomic-specific modifier and is appropriate for surgical and diagnostic services. This modifier is not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "FB",
                "special_coding_instructions" => "This modifier is intended for use with procedures or devices submitted by ASCs.
ASCs must append modifier FB to the HCPCS device procedure code when the device is furnished without cost or with full credit and only when billed with the associated implantation procedure code found in List A below. A single procedure code should not be submitted with both modifiers FB and FC.
For further billing instructions, refer to CMS CR7275.
This modifier can be reported with the following HCPCS codes for devices: C1721, C1722, C1764, C1767, C1771, C1772, C1776, C1777, C1778, C1779, C1820, C1881, C1882, C1891, C1895, C1896, C1897, C1898, C1899, C2626, C2631, and L8614.
List A: 33206, 33207, 33208, 33210, 33211, 33212, 33213, 33214, 33216, 33217, 33282, 36566, 53440, 53444, 53445, 53447, 54400, 54401, 54405, 54410, 62362, 63650, 63655, 63685, 64553, 64555, 64560, 64561, 64565, 64573, 64590, and 69930.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "FC",
                "special_coding_instructions" => "This modifier is intended for use with procedures or devices submitted by ASCs.
ASCs must append modifier FC to the HCPCS device procedure code for the surgery when a device is furnished with a partial credit for a replacement device. A single procedure code should not be submitted with both modifiers FB and FC.
For further billing instructions, refer to CMS CR7275.
This modifier can be reported with the following HCPCS codes for devices: C1721, C1722, C1764, C1767, C1771, C1772, C1776, C1777, C1778, C1779, C1785, C1786, C1813, C1815, C1820, C1881, C1882, C1891, C1895, C1896, C1897, C1898, C1899, C1900, C2619, C2620, C2621, C2622, C2626, C2631, and L8614.
List A: 33206, 33207, 33208, 33210, 33211, 33212, 33213, 33214, 33216, 33217, 33240, 33249, 33224, 33225, 33282, 36566, 53440, 53444, 53445, 53447, 54400, 54401, 54405, 54410, 54416, 61885, 61886, 62361, 62362, 63650, 63655, 63685, 64553, 64555, 64560, 64561, 64565, 64573, 64575, 64577, 64580, 64581, 64590, and 69930.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "FP",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G1",
                "special_coding_instructions" => "Modifiers G1 through G6 are used for reporting the urea reduction ratio (URR) for determining the adequacy of hemodialysis. KMAP will deny the service if billed with any of these modifiers for codes other than 90999.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G2",
                "special_coding_instructions" => "Modifiers G1 through G6 are used for reporting the urea reduction ratio (URR) for determining the adequacy of hemodialysis. KMAP will deny the service if billed with any of these modifiers for codes other than 90999.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G3",
                "special_coding_instructions" => "Modifiers G1 through G6 are used for reporting the urea reduction ratio (URR) for determining the adequacy of hemodialysis. KMAP will deny the service if billed with any of these modifiers for codes other than 90999.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G4",
                "special_coding_instructions" => "Modifiers G1 through G6 are used for reporting the urea reduction ratio (URR) for determining the adequacy of hemodialysis. KMAP will deny the service if billed with any of these modifiers for codes other than 90999.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G5",
                "special_coding_instructions" => "Modifiers G1 through G6 are used for reporting the urea reduction ratio (URR) for determining the adequacy of hemodialysis. KMAP will deny the service if billed with any of these modifiers for codes other than 90999.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G6",
                "special_coding_instructions" => "Modifiers G1 through G6 are used for reporting the urea reduction ratio (URR) for determining the adequacy of hemodialysis. KMAP will deny the service if billed with any of these modifiers for codes other than 90999.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G7",
                "special_coding_instructions" => "This modifier can only be submitted with the following CPT® codes: 00940, 01964, 01965, 01966, 59840, 59841, 59850, 59851, 59852, 59855, 59856, 59857, 59866, S0190, S0191, S0199, and S2260.
KMAP will deny the service if this modifier is billed with any code other than those listed previously. For further information, refer to the Professional Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "G8",
                "special_coding_instructions" => "Modifier G8 should only be used with the following anesthesia codes: 00100, 00160, 00300, 00400, 00532, and 00920. KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => ['QS']
            ],
            [
                "modifier" => "G9",
                "special_coding_instructions" => "Submit this modifier only with anesthesia services (such as codes 00100 – 01999).
KMAP will deny services billed with modifier G9 on codes other than the anesthesia series of codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GA",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GB",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GC",
                "special_coding_instructions" => "Modifier GC must be used by the physician for teaching physician services. A teaching physician service billed using this modifier is certifying that he or she has been present during the key portion of the service and was immediately available during the other parts of the service.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GD",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GE",
                "special_coding_instructions" => "Submit this modifier with services performed by a resident in a teaching facility without the presence of a teaching physician.
This modifier is informational and can only be submitted with procedure codes included in the primary care exception:
HCPCS code: G0344
CPT® codes: 99201 – 99203, 99211 – 99213, 93005 and 93041",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GF",
                "special_coding_instructions" => "For services rendered in a critical access hospital (CAH) by a nurse practitioner (NP), clinical nurse specialist (CNS), certified registered nurse (CRN) or physician assistant (PA), use this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GG",
                "special_coding_instructions" => "Modifier GG is used when a diagnostic and a screening mammogram are performed on the same day for the same patient. Modifier GG is added to the diagnostic mammography code only. Both the diagnostic and screening codes must be billed on the same claim form. Submit modifier GG with the diagnostic mammography code. CMS uses this modifier for tracking and data collection purposes.
This modifier can be submitted with the following codes:
CPT® codes: 76082, 76090, 76091, 77051, 77055 and 77056
HCPCS codes: G0204, G0206, and G0236
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GH",
                "special_coding_instructions" => "When a screening mammogram indicates a potential problem, the interpreting radiologist can order additional films during the same visit on the same day without an additional order from the treating physician. The radiologist must report to the treating physician the condition of the patient. These additional films, with the report to the treating physician, convert a screening mammogram to a diagnostic mammogram. The procedure code is reported with modifier GH to indicate the radiologist converted the screening mammogram to a diagnostic mammogram.
This modifier can be submitted with CPT® codes: 76090, 76091, 77055 and 77056.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GJ",
                "special_coding_instructions" => "This modifier is used specific to Medicare. Medicare rules: Physicians who have opted out of Medicare (also called private contracting) are not permitted to submit services to Medicare; however, the exception to this rule is when services are provided on an emergent or urgent basis. Opt-out physicians and practitioners must submit these services to Medicare with modifier GJ. In order to opt out of Medicare, physicians and practitioners who are permitted to opt out must follow certain procedures and guidelines.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GK",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GL",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GM",
                "special_coding_instructions" => "This modifier can be submitted only with claims for ambulance transport, A0021-A0999. KMAP will deny the service if this modifier is billed with any code other than those listed previously",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GN",
                "special_coding_instructions" => "Submit modifier GN to indicate the services were delivered under an outpatient speech language pathology plan of care. KMAP has determined it is appropriate to use modifier GN on the following codes: 64550, G0281, G0283, G0329, 0019T, 0029T, 0183T, 90901, 92520, 92506, 92507, 92508, 92526, 92597, 92605, 92606, 92607, 92608, 92609, 92610, 92611, 92612, 92614, 92616, 95831, 95832, 95833, 95834, 95851, 95852, 96105, 96110, 96111, 96125, 97001, 97002, 97003, 97004, 97010, 97012, 97016, 97018, 97022, 97024, 97026, 97028, 97032, 97033, 97034, 97035, 97036, 97039, 97110, 97112, 97113, 97116, 97124, 97139, 97140, 97150, 97530, 97532, 97533, 97535, 97537, 97542, 97597, 97598, 97602, 97605, 97606, 97750, 97755, 97760, 97761, 97762 and 97799.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GO",
                "special_coding_instructions" => "Submit modifier GO to indicate services delivered under an outpatient occupational plan of care. KMAP has determined it is appropriate to use modifier GO on the following codes: 64550, G0281, G0283, G0329, 0019T, 0029T, 0183T, 90901, 92520, 92506, 92507, 92508, 92526, 92597, 92605, 92606, 92607, 92608, 92609, 92610, 92611, 92612, 92614, 92616, 95831, 95832, 95833, 95834, 95851, 95852, 96105, 96110, 96111, 96125, 97001, 97002, 97003, 97004, 97010, 97012, 97016, 97018, 97022, 97024, 97026, 97028, 97032, 97033, 97034, 97035, 97036, 97039, 97110, 97112, 97113, 97116, 97124, 97139, 97140, 97150, 97530, 97532, 97533, 97535, 97537, 97542, 97597, 97598, 97602, 97605, 97606, 97750, 97755, 97760, 97761, 97762 and 97799.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GP",
                "special_coding_instructions" => "Submit this modifier with services delivered under an outpatient physical therapy plan of care. KMAP has determined it is appropriate to use modifier GP on the following codes: 64550, G0281, G0283, G0329, 0019T, 0029T, 0183T, 90901, 92520, 92506, 92507, 92508, 92526, 92597, 92605, 92606, 92607, 92608, 92609, 92610, 92611, 92612, 92614, 92616, 95831, 95832, 95833, 95834, 95851, 95852, 96105, 96110, 96111, 96125, 97001, 97002, 97003, 97004, 97010, 97012, 97016, 97018, 97022, 97024, 97026, 97028, 97032, 97033, 97034, 97035, 97036, 97039, 97110, 97112, 97113, 97116, 97124, 97139, 97140, 97150, 97530, 97532, 97533, 97535, 97537, 97542, 97597, 97598, 97602, 97605, 97606, 97750, 97755, 97760, 97761, 97762 and 97799.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GQ",
                "special_coding_instructions" => "KMAP has determined modifier GQ can only be submitted with the following codes: H0001, H0004, H0005, H0006, H0007, H0015, H0038, 99241-99255, 99201-99215, 90804-90809, 90862, 90801, G0308, G0309, G0311, G0312, G0314, G0315, G0317, G0270, 97802, 97803, 96116, G0406, G0407, G0408, T1030, T1031, 99261-99263, 99271-99275, 90847, Q3014, 90951, 90952, 90954, 90955, 90957, 90958, 90960 and 90961.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GR",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GS",
                "special_coding_instructions" => "This modifier can be submitted with codes: J0881, J0882, J0885, J0886, and Q4081. KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GT",
                "special_coding_instructions" => "The local policy E2008-056 (Substance Abuse Services: Peer Support & Crisis Intervention) allows for codes H0001, H0004, H0005, H0006, H0007 and H0038 to be billed with modifier GT when provided through telecommunication technology. For further information regarding the use of telemedicine, refer to the General Benefits Provider Manual and Non-PIHP Alcohol and Substance Abuse Community Based Services Provider Manual.
The local policy E2006-096 (Changes to Coverage of Home Telehealth Services) required the use of modifier GT with procedure codes T1030 and T1031when filing claims to Medicaid for home telehealth visits. For further information regarding the use of home telehealth services, refer to the Home Health Agency Provider Manual.
This modifier, when appropriate, can only be submitted with the following codes: 90801, 90804 – 90809, 90847, 90862, 90951, 90952, 90954, 90955, 90957, 90958, 90960, 90961, 96116, 97802, 97803, 99201 – 99215, 99241 – 99255, 99261 – 99263, 99271 – 99275, G0270, G0308, G0309, G0311, G0312, G0314, G0315, G0317, G0318, G0406, G0407, G0408, G0425, G0426, G0427, H0001, H0004, H0005, H0006, H0007, H0038, Q3014, T1030 and T1031.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GU",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GV",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing
for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GW",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing
for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GX",
                "special_coding_instructions" => "This modifier can be submitted with all HCPCS and CPT® codes, as applicable.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GY",
                "special_coding_instructions" => "Refer to the Home Health Agency Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "GZ",
                "special_coding_instructions" => "Medicare will automatically deny any service with modifier GZ appended as not medically necessary. The denial will reflect a claim adjustment reason code (CARC) of 50 and a group code of contractual obligation (CO) to show provider/supplier liability because an Advance Beneficiary Notice was not issued to the beneficiary.
Medicaid will also follow Medicare policy and begin automatically denying any services with a modifier GZ appended as not medically necessary with a CARC of 50 and a group code of CO.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "H9",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HA",
                "special_coding_instructions" => "The local policy E2003-047 (Non-coverage of CMHC, MH Local Codes) established it is appropriate to use modifier HA on the following codes if billing for services in a child/adolescent program: H0015, H0032, H0036 and T1019. KMAP will deny the service if this modifier is billed with any code other than those listed previously.
For further information related to the child/adolescent program, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HB",
                "special_coding_instructions" => "The local policy E2007-010 (Mental Health Prepaid Ambulatory Health Plan [MH – PAHP]) established it is appropriate to use modifier HB with code H0036, when applicable. KMAP will deny the service if this modifier is billed with any code other than H0036.
For further information related to these services, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HC",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HD",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HE",
                "special_coding_instructions" => "The local policy E2003-047 (Non-coverage of CMHC, MH Local Codes) established it is appropriate to bill modifier HE with code T1019, when applicable.
KMAP will deny the service if this modifier is billed with any code other than T1019.
For further information related to this program, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HF",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HG",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HH",
                "special_coding_instructions" => "The local policy E2007-010 (Mental Health Prepaid Ambulatory Health Plan [MH – PAHP]) established it is appropriate to bill modifier HH on code H0036, when applicable.
KMAP will deny the service if this modifier is billed with any code other than H0036.
For further information related to this program, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HI",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HJ",
                "special_coding_instructions" => "The local policy E2007-010 (Mental Health Prepaid Ambulatory Health Plan [MH – PAHP]) established it is appropriate to bill modifier HJ on code H0036, when applicable.
KMAP will deny the service if this modifier is billed with any code other than H0036.
For further information related to this program, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HK",
                "special_coding_instructions" => "The local policy E2007-010 (Mental Health Prepaid Ambulatory Health Plan [MH – PAHP]) established it is appropriate to bill modifier HK on codes 90847, H0036, H2011, H2015 and T1019, when applicable. KMAP will deny the service if this modifier is billed with any code other than those listed previously.
For further information related to these programs, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HL",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HM",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HN",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HO",
                "special_coding_instructions" => "The local policy E2007-010 (Mental Health Prepaid Ambulatory Health Plan [MH – PAHP]) requires modifier HO for code H2011 when performed for emergent crisis intervention by a licensed mental health professional (LMHP). KMAP will deny the service if this modifier is billed with any code other than H2011. For further information related to these services, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HP",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HQ",
                "special_coding_instructions" => "The local policy E2007-010 (Mental Health Prepaid Ambulatory Health Plan [MH – PAHP]) required modifier HQ on procedure codes H2017 or H0038, when applicable. For further information, refer to the Non-PAHP Outpatient Mental Health Provider Manual.
The local policy E2007-038 (Autism Waiver) established the use of modifier HQ for billing S9482 or T1027, when applicable. For further information, refer to the Home and Community Based Services (HCBS) Autism Provider Manual.
The local policy E2008-056 (Substance Abuse Services: Peer Support & Crisis Intervention) required modifier HQ on procedure code H0038, when applicable. For further information, please refer to the Non-PIHP Alcohol and Substance Abuse Community Based Services Provider Manual.
This modifier, when appropriate, can only be submitted with the following codes: H0038, H2017, S9482, and T1027. KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HR",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HS",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HT",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HU",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HV",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HW",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HX",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HY",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "HZ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "J1",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "J2",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "J3",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "J4",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "JA",
                "special_coding_instructions" => "These modifiers are informational only and can be submitted with all injection codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "JB",
                "special_coding_instructions" => "These modifiers are informational only and can be submitted with all injection codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "JC",
                "special_coding_instructions" => "Modifiers JC and JD can be used with codes Q4100 through Q4114.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "JD",
                "special_coding_instructions" => "Modifiers JC and JD can be used with codes Q4100 through Q4114.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "JW",
                "special_coding_instructions" => "Use this modifier when submitting a claim for drugs that were discarded, not administered. Submit the used and unused portions of the drug on a single detail line.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "K0",
                "special_coding_instructions" => "Prosthetic claims for knees, feet and ankles should be submitted with modifiers K0 through K4, indicating the expected patient functional level.
This modifier can be submitted with codes L5000 – L5999.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "K1",
                "special_coding_instructions" => "Prosthetic claims for knees, feet and ankles should be submitted with modifiers K0 through K4, indicating the expected patient functional level.
This modifier can be submitted with codes L5000 – L5999.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "K2",
                "special_coding_instructions" => "Prosthetic claims for knees, feet and ankles should be submitted with modifiers K0 through K4, indicating the expected patient functional level.
This modifier can be submitted with codes L5000 – L5999.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "K3",
                "special_coding_instructions" => "Prosthetic claims for knees, feet and ankles should be submitted with modifiers K0 through K4, indicating the expected patient functional level.
This modifier can be submitted with codes L5000 – L5999.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "K4",
                "special_coding_instructions" => "Prosthetic claims for knees, feet and ankles should be submitted with modifiers K0 through K4, indicating the expected patient functional level.
This modifier can be submitted with codes L5000 – L5999.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KA",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KB",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KC",
                "special_coding_instructions" => "KMAP uses the Medicare Durable Medical Equipment, Prosthetics/Orthotics & Supplies Fee Schedule to determine which procedures are appropriately billed with modifier KC.
Procedure codes allowed to be billed with modifier KC will appear on the file with the modifier KC (such as E2312 KC). KMAP will deny any procedure billed to Medicaid that includes modifier KC and is not found on this file.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KD",
                "special_coding_instructions" => "Use modifier KD to indicate the administration of a drug through a DME home infusion pump.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KE",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KF",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KG",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KH",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KI",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KJ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KK",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KL",
                "special_coding_instructions" => "KMAP uses the Medicare Durable Medical Equipment, Prosthetics/Orthotics & Supplies Fee Schedule to determine which procedures can be billed with modifiers KL, KM, and KN.
Applicable procedure codes appear on the file with modifier KL, KM, or KN (such as A4233 KL, L8040 KM, L8047 KN). Any procedure not listed with modifier KL, KM, or KN will be denied by KMAP.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KM",
                "special_coding_instructions" => "KMAP uses the Medicare Durable Medical Equipment, Prosthetics/Orthotics & Supplies Fee Schedule to determine which procedures can be billed with modifiers KL, KM, and KN.
Applicable procedure codes appear on the file with modifier KL, KM, or KN (such as A4233 KL, L8040 KM, L8047 KN). Any procedure not listed with modifier KL, KM, or KN will be denied by KMAP.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KN",
                "special_coding_instructions" => "KMAP uses the Medicare Durable Medical Equipment, Prosthetics/Orthotics & Supplies Fee Schedule to determine which procedures can be billed with modifiers KL, KM, and KN.
Applicable procedure codes appear on the file with modifier KL, KM, or KN (such as A4233 KL, L8040 KM, L8047 KN). Any procedure not listed with modifier KL, KM, or KN will be denied by KMAP.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KO",
                "special_coding_instructions" => "Use modifier KO when a single drug is dispensed in a unit dose container. Modifier KO should not be used with the concentrated form codes or HCPCS code J7621.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KP",
                "special_coding_instructions" => "Use modifiers KP and KQ when two or more drugs are combined and dispensed to a patient in the same unit dose container. Add modifier KP to one of the unit dose form codes and modifier KQ to all other unit dose codes. The use of modifiers KP and KQ should result in a combination yielding the lower cost to the beneficiary. Modifiers KP and KQ are not used with the concentrated form codes or HCPCS code J7621.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KQ",
                "special_coding_instructions" => "Use modifiers KP and KQ when two or more drugs are combined and dispensed to a patient in the same unit dose container. Add modifier KP to one of the unit dose form codes and modifier KQ to all other unit dose codes. The use of modifiers KP and KQ should result in a combination yielding the lower cost to the beneficiary. Modifiers KP and KQ are not used with the concentrated form codes or HCPCS code J7621.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KR",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KS",
                "special_coding_instructions" => "The local policy E2004-040 (Coverage of Diabetic Supplies) established the invalid modifier-to-modifier combination of KS and KX. Modifier KX must be used if the beneficiary is insulin treated (insulin dependent diabetic). Modifier KS must be used if the beneficiary is not insulin treated (noninsulin dependent diabetic). Modifiers KX and KS cannot be billed together on a single detail line. If no modifier is included, the claim will deny. For further billing/coding instructions, refer to the Home Health Agency Provider Manual and Durable Medical Equipment Provider Manual.",
                "invalid_combinations" => ["KX"]
            ],
            [
                "modifier" => "KT",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KU",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KV",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KW",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KX",
                "special_coding_instructions" => "The local policy E2004-040 (Coverage of Diabetic Supplies) established the invalid modifier-to-modifier combination of KS and KX. Modifier KX must be used if the beneficiary is insulin treated (insulin dependent diabetic). Modifier KS must be used if the beneficiary is not insulin treated (noninsulin dependent diabetic). Modifiers KX and KS cannot be billed together on a single detail line. If no modifier is included, the claim will deny.
For further billing/coding instructions, refer to the Home Health Agency Provider Manual and Durable Medical Equipment Provider Manual.",
                "invalid_combinations" => ["KS"]
            ],
            [
                "modifier" => "KY",
                "special_coding_instructions" => "If a service is billed with modifier KY, it will be denied.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "KZ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "LC",
                "special_coding_instructions" => "Under certain circumstances, a physician may need to indicate a procedure or service was distinct or independent from other services performed on the same day. HCPCS modifier LC is used to identify situations when it is appropriate to submit these specific CPT® codes for separate reimbursement.
This modifier can be submitted with the following CPT® codes: 92980 – 92982, 92984, 92978 – 92982, 92995 – 92996, 93556 and 93971.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "LD",
                "special_coding_instructions" => "This modifier can be submitted with the following CPT® codes: 92973, 92978, 92980 – 92982, 92984, 92995 – 92996 and 93571 – 93573.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "LL",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "LO",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "LR",
                "special_coding_instructions" => "Modifier LR can only be submitted by independent clinical laboratories with HCPCS codes P9603 and P9604. KMAP will deny the service if billed with this modifier on any other codes except P9603 and P9604.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "LS",
                "special_coding_instructions" => "Submit on physician claims for eye surgery with intraocular lens (IOL) implants.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "LT",
                "special_coding_instructions" => "For further information related to the usage of modifier LT, refer to the Professional Provider Manual, Vision Provider Manual, and Audiology Provider Manual.",
                "invalid_combinations" => ["50"]
            ],
            [
                "modifier" => "M2",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "MS",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "NB",
                "special_coding_instructions" => "Modifier NB is valid for use with HCPCS codes E0550 through E0585.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "NR",
                "special_coding_instructions" => "Use modifier NR when DME which was new at the time of rental is subsequently purchased.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "NU",
                "special_coding_instructions" => "KMAP uses the Medicare Durable Medical Equipment, Prosthetics/Orthotics & Supplies Fee Schedule to determine which procedures are appropriately billed with modifier NU.
Procedure codes listed on the file with modifier NU can be billed with this modifier (such as A4233 NU). Any procedure code not listed on this file with modifier NU will be denied.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "PA",
                "special_coding_instructions" => "Surgical and other invasive procedures are defined as operative procedures in which skin or mucous membranes and connective tissue are incised or an instrument is introduced through a natural body orifice. Invasive procedures include a range of procedures from minimally invasive dermatological procedures (biopsy, excision, and deep cryotherapy for malignant lesions) to extensive multi-organ transplantation. They include all procedures described by the codes in the Surgery section of the CPT® codebook and other invasive procedures such as percutaneous transluminal angioplasty and cardiac catheterization. They include minimally invasive procedures involving biopsies or placement of probes or catheters requiring the entry into a body cavity through a needle or trocar. They do not include use of instruments such as otoscopes for examinations or very minor procedures such as drawing blood. A surgical or other invasive procedure is considered to be the wrong procedure if it is inconsistent with the correctly documented informed consent for that patient.
A surgical or other invasive procedure is considered to have been performed on the wrong body part if it is inconsistent with the correctly documented informed consent for that patient including surgery on the right body part but the wrong location on the body. This includes left versus right (appendages and/or organs) or at the wrong level (spine).
Note: Emergent situations occurring during the course of surgery and/or whose exigency precludes obtaining informed consent are not considered erroneous under this decision. Also, the event is not intended to capture changes in the plan upon surgical entry into the patient due to the discovery of pathology in close proximity to the intended site when the risk of a second surgery outweighs the benefit of patient consultation or due to the discovery of an unusual physical configuration (such as, adhesions, spine level/extra vertebrae). A surgical or other invasive procedure is considered to have been performed on the wrong patient if the procedure is inconsistent with the correctly documented informed consent for that patient.
Hospital outpatient departments, ASCs, practitioners and those submitting other appropriate Type of Bills (TOBs) are required to append one of the following applicable National Coverage Determinations (NCD) modifiers to all lines related to the erroneous surgery(s): PA, PB, or PC.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "PB",
                "special_coding_instructions" => "Surgical and other invasive procedures are defined as operative procedures in which skin or mucous membranes and connective tissue are incised or an instrument is introduced through a natural body orifice. Invasive procedures include a range of procedures from minimally invasive dermatological procedures (biopsy, excision, and deep cryotherapy for malignant lesions) to extensive multi-organ transplantation. They include all procedures described by the codes in the Surgery section of the CPT® codebook and other invasive procedures such as percutaneous transluminal angioplasty and cardiac catheterization. They include minimally invasive procedures involving biopsies or placement of probes or catheters requiring the entry into a body cavity through a needle or trocar. They do not include use of instruments such as otoscopes for examinations or very minor procedures such as drawing blood. A surgical or other invasive procedure is considered to be the wrong procedure if it is inconsistent with the correctly documented informed consent for that patient.
A surgical or other invasive procedure is considered to have been performed on the wrong body part if it is inconsistent with the correctly documented informed consent for that patient including surgery on the right body part but the wrong location on the body. This includes left versus right (appendages and/or organs) or at the wrong level (spine).
Note: Emergent situations occurring during the course of surgery and/or whose exigency precludes obtaining informed consent are not considered erroneous under this decision. Also, the event is not intended to capture changes in the plan upon surgical entry into the patient due to the discovery of pathology in close proximity to the intended site when the risk of a second surgery outweighs the benefit of patient consultation or due to the discovery of an unusual physical configuration (such as, adhesions, spine level/extra vertebrae). A surgical or other invasive procedure is considered to have been performed on the wrong patient if the procedure is inconsistent with the correctly documented informed consent for that patient.
Hospital outpatient departments, ASCs, practitioners and those submitting other appropriate Type of Bills (TOBs) are required to append one of the following applicable National Coverage Determinations (NCD) modifiers to all lines related to the erroneous surgery(s): PA, PB, or PC.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "PC",
                "special_coding_instructions" => "Surgical and other invasive procedures are defined as operative procedures in which skin or mucous membranes and connective tissue are incised or an instrument is introduced through a natural body orifice. Invasive procedures include a range of procedures from minimally invasive dermatological procedures (biopsy, excision, and deep cryotherapy for malignant lesions) to extensive multi-organ transplantation. They include all procedures described by the codes in the Surgery section of the CPT® codebook and other invasive procedures such as percutaneous transluminal angioplasty and cardiac catheterization. They include minimally invasive procedures involving biopsies or placement of probes or catheters requiring the entry into a body cavity through a needle or trocar. They do not include use of instruments such as otoscopes for examinations or very minor procedures such as drawing blood. A surgical or other invasive procedure is considered to be the wrong procedure if it is inconsistent with the correctly documented informed consent for that patient.
A surgical or other invasive procedure is considered to have been performed on the wrong body part if it is inconsistent with the correctly documented informed consent for that patient including surgery on the right body part but the wrong location on the body. This includes left versus right (appendages and/or organs) or at the wrong level (spine).
Note: Emergent situations occurring during the course of surgery and/or whose exigency precludes obtaining informed consent are not considered erroneous under this decision. Also, the event is not intended to capture changes in the plan upon surgical entry into the patient due to the discovery of pathology in close proximity to the intended site when the risk of a second surgery outweighs the benefit of patient consultation or due to the discovery of an unusual physical configuration (such as, adhesions, spine level/extra vertebrae). A surgical or other invasive procedure is considered to have been performed on the wrong patient if the procedure is inconsistent with the correctly documented informed consent for that patient.
Hospital outpatient departments, ASCs, practitioners and those submitting other appropriate Type of Bills (TOBs) are required to append one of the following applicable National Coverage Determinations (NCD) modifiers to all lines related to the erroneous surgery(s): PA, PB, or PC.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "PI",
                "special_coding_instructions" => "Modifier PI must be used for positron-emission tomography (PET) or PET/computed tomography (CT) scans done to determine the initial treatment strategy for tumors that are biopsy proven or strongly suspected of being cancerous based on other diagnostic testing, one per cancer diagnosis.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "P1",
                "special_coding_instructions" => "Modifiers P1 through P6 can be used with anesthesia procedure codes 00100 – 03108. These modifiers identify the appropriate physical status of the patient and distinguish the various levels of complexity of the anesthesia service provided.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "P2",
                "special_coding_instructions" => "Modifiers P1 through P6 can be used with anesthesia procedure codes 00100 – 03108. These modifiers identify the appropriate physical status of the patient and distinguish the various levels of complexity of the anesthesia service provided.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "P3",
                "special_coding_instructions" => "Modifiers P1 through P6 can be used with anesthesia procedure codes 00100 – 03108. These modifiers identify the appropriate physical status of the patient and distinguish the various levels of complexity of the anesthesia service provided.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "P4",
                "special_coding_instructions" => "Modifiers P1 through P6 can be used with anesthesia procedure codes 00100 – 03108. These modifiers identify the appropriate physical status of the patient and distinguish the various levels of complexity of the anesthesia service provided.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "P5",
                "special_coding_instructions" => "Modifiers P1 through P6 can be used with anesthesia procedure codes 00100 – 03108. These modifiers identify the appropriate physical status of the patient and distinguish the various levels of complexity of the anesthesia service provided.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "P6",
                "special_coding_instructions" => "Modifiers P1 through P6 can be used with anesthesia procedure codes 00100 – 03108. These modifiers identify the appropriate physical status of the patient and distinguish the various levels of complexity of the anesthesia service provided.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "PL",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "PS",
                "special_coding_instructions" => "Modifier PS must be used for PET or PET/CT scans done to determine the subsequent treatment strategy of cancerous tumors when the beneficiary’s treating physician determines it is needed to determine subsequent anti-tumor strategy.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "PT",
                "special_coding_instructions" => "Submit this modifier with the appropriate CPT® code for colonoscopy, flexible sigmoidoscopy, or barium enema when the service is initiated as a colorectal cancer screening service but becomes a diagnostic service. Modifier PT is valid for use with CPT® codes 10000 through 69999. See the MLN Matters article, MM7012.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q0",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q1",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q2",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q3",
                "special_coding_instructions" => "Submit modifier Q3 with live kidney donor preoperative, intraoperative, and postoperative services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q4",
                "special_coding_instructions" => "This modifier is informational only and can be submitted with the following codes.
CPT® codes: 80002 – 89399
HCPCS codes: G0058 – G0060",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q5",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q6",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q7",
                "special_coding_instructions" => "Modifiers Q7, Q8, and Q9 can be used with the following codes: G0127, 11055, 11056, 11057, 11719, 11720, and 11721. KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q8",
                "special_coding_instructions" => "Modifiers Q7, Q8, and Q9 can be used with the following codes: G0127, 11055, 11056, 11057, 11719, 11720, and 11721. KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "Q9",
                "special_coding_instructions" => "Modifiers Q7, Q8, and Q9 can be used with the following codes: G0127, 11055, 11056, 11057, 11719, 11720, and 11721. KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QC",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QD",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QE",
                "special_coding_instructions" => "Modifier QE can be used with codes E0424, E0439, E1390 and E1391.
This modifier must not be used with codes for portable systems or oxygen contents.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QF",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QG",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QH",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QI",
                "special_coding_instructions" => "Modifier QJ indicates the provider has been instructed by the state or local government agency that requested the healthcare items or services provided to the patient that state or local law makes the prisoner or patient responsible to repay the cost of medical services.
Collection of debts incurred for furnishing such items or services is pursued with the same vigor and in the same manner as any other debt.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QK",
                "special_coding_instructions" => "Modifier QK can only be submitted with anesthesia procedure codes (such as CPT® codes 00100 – 01999). KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QL",
                "special_coding_instructions" => "Modifiers QL, QM, and QN can be used on codes A0021 – A0999.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QM",
                "special_coding_instructions" => "Modifiers QL, QM, and QN can be used on codes A0021 – A0999.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QN",
                "special_coding_instructions" => "Modifiers QL, QM, and QN can be used on codes A0021 – A0999.
KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QP",
                "special_coding_instructions" => "It is appropriate to use modifier QP when the laboratory test was ordered as a single test or when a single code is available for a grouping of tests.
Modifier QP indicates the test was ordered individually or ordered as a recognized panel other than automated profile codes 80002 – 80019 and G0058 – G0060. Modifier QP can be submitted with codes 80100 – 89356.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QS",
                "special_coding_instructions" => "Modifier QS can only be submitted with anesthesia procedure codes (such as CPT® codes 00100 – 01999).
KMAP will deny the service if this modifier is billed with any code other than those identified previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QT",
                "special_coding_instructions" => "This modifier can be submitted with all HCPCS and CPT® codes.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QW",
                "special_coding_instructions" => "The regulations of the Clinical Laboratory Improvement Amendments (CLIA) of 1988 require a facility to be appropriately certified for each test performed.
To ensure CMS pays only for laboratory tests categorized as waived complexity under CLIA in facilities with a CLIA certificate of waiver, laboratory claims are currently edited at the CLIA certificate level. KMAP uses the List of Waived Tests file to determine which procedures are appropriately billed with modifier QW.
Procedures that do not require modifier QW include CPT® codes 81002, 81025, 82270, 82272, 82962, 83026, 84830, 85013, 85651, and HCPCS code G0394
KMAP will deny the service if this modifier is billed with any code other than those identified on the List of Waived Tests file.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QX",
                "special_coding_instructions" => "Modifiers QX, QY, and QZ can only be submitted with anesthesia procedure codes (such as CPT® codes 00100 – 01999). KMAP will deny the service if these modifiers are billed with any code other than those identified previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QY",
                "special_coding_instructions" => "Modifiers QX, QY, and QZ can only be submitted with anesthesia procedure codes (such as CPT® codes 00100 – 01999). KMAP will deny the service if these modifiers are billed with any code other than those identified previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "QZ",
                "special_coding_instructions" => "Modifiers QX, QY, and QZ can only be submitted with anesthesia procedure codes (such as CPT® codes 00100 – 01999). KMAP will deny the service if these modifiers are billed with any code other than those identified previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RA",
                "special_coding_instructions" => "Modifier RA is used for a replacement due to loss, irreparable damage or theft of a DME, orthotic, or prosthetic item.
Modifier RA must only be used on the first month rental claim for a replacement item.
The local policy PC457 (Clarification of Hearing Aid Replacements) established the requirement of modifier RA. In accordance with this policy, modifier RA must be present on all claims for replacement hearing aids.
This modifier can be submitted with the following codes, when applicable: V5030, V5040, V5050, V5060, V5090, V5241, V5242, V5243, V5244, V5245, V5246, V5247, V5254, V5255, V5256, and V5257.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RB",
                "special_coding_instructions" => "Modifier RB can be used on a DME POS claim to indicate replacement parts of a DME, orthotic, or prosthetic item furnished as part of the service of repairing the item.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RC",
                "special_coding_instructions" => "This modifier can be submitted with the following CPT® codes: 92973, 92980-92982, 92984 and 92995 – 92996.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RD",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RE",
                "special_coding_instructions" => "Modifier RE can be submitted with all procedure codes, as appropriate.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RP",
                "special_coding_instructions" => "Modifier RP can be used to indicate replacement of DME, orthotic, and prosthetic devices which have been in use for some time. Modifier RP will no longer be recognized for the use of repair and replacement. Modifiers RA and RB can be used instead.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RR",
                "special_coding_instructions" => "For further information, refer to the DME/Medical Supply Dealer Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "RT",
                "special_coding_instructions" => "For further information related to the usage of modifier RT, refer to the Professional Provider Manual, Vision Provider Manual, and Audiology Provider Manual.",
                "invalid_combinations" => ["50"]
            ],
            [
                "modifier" => "SA",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SB",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SC",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SD",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SF",
                "special_coding_instructions" => "Modifier SF can be submitted with the following CPT® codes, when applicable: 66820 – 66821, 66830, 66840, 66850, 66915, 66920, 66930, 66940, 66945 and 66983 – 66985.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SG",
                "special_coding_instructions" => "Modifier SG is no longer required by Medicare for ASC facility charges. For dates of service prior to January 1, 2008, Medicare does require ASC facility charges to be submitted with modifier SG. However, Medicaid does not require modifier SG to be used with ASC facility charges.
For ASC facility charges for procedures which are discontinued prior to the induction of anesthesia, see also CPT® modifier 73.
For ASC facility charges for procedures which are discontinued after administration of anesthesia, see also CPT® modifier 74.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SH",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SJ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SK",
                "special_coding_instructions" => "Submit modifier SK only with the following codes for immunization, when appropriate: 90371, 90375, 90376, 90385, 90465, 90466, 90467, 90468, 90473, 90474, 90585, 90586, 90632, 90633, 90645, 90647, 90648, 90655, 90656, 90657, 90658, 90660, 90663, 90669, 90675, 90691, 90700, 90702, 90703, 90704, 90705, 90706, 90707, 90713, 90714, 90715, 90716, 90717, 90718, 90721, 90732, 90733, 90735, 90740, 90743, 90744, 90746, 90747, G0008, G0009, G0010, 90471, 90472, G9141 and G9142.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SL",
                "special_coding_instructions" => "The local policy E2007-020 (Changes in vaccine coverage for children) established appropriate usage of modifier SL for vaccine codes 90655, 90656, 90657, and 90658.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.
For further information, refer to the Home Health Provider Manual and Professional Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SM",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SN",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SQ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SS",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "ST",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SU",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SV",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SW",
                "special_coding_instructions" => "Submit modifier SW with the following codes when provided by a certified diabetes educator.
Diabetes Self-Management Training (DSMT): HCPCS codes G0108 – G0109
Medical Nutrition Therapy (MNT): CPT® codes 97802 – 97804, HCPCS codes
G0270 – G0271",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "SY",
                "special_coding_instructions" => "Use Modifier SY only with the following codes for immunization, when appropriate: 90371, 90375, 90376, 90385, 90465, 90466, 90467, 90468, 90471, 90472, 90473, 90474, 90585, 90586, 90632, 90633, 90645, 90647, 90648, 90655, 90656, 90657, 90658, 90660, 90663, 90669, 90675, 90691, 90700, 90702, 90703, 90704, 90705, 90706, 90707, 90713, 90714, 90715, 90716, 90717, 90718, 90721, 90732, 90733, 90735, 90740, 90743, 90744, 90746, 90747, G0008, G0009, G0010, G9141, and G9142.
KMAP will deny the service if this modifier is billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T1",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T2",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T3",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T4",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T5",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T6",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T7",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T8",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "T9",
                "special_coding_instructions" => "Modifiers T1 through T9 are appropriate for surgical and diagnostic services.
These modifiers are not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TA",
                "special_coding_instructions" => "This modifier is appropriate for surgical and diagnostic services.
This modifier is not appropriate for E&M services.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TC",
                "special_coding_instructions" => "If billing for the global component (both professional & technical) of a procedure, modifiers 26 & TC must not be used. KMAP uses the Medicare Physician Fee Schedule Relative Value file to determine which procedures are appropriately billed with modifier TC. KMAP uses the PT/TC indicator field on the file as a basis to determine proper usage of modifier TC. The following determinations have been made based on the individual indicators.
This modifier must not be used on procedures which have a PC/TC indicator equal to 0, 2, 3, 4, 5, 6, 8, and 9 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid which has been assigned one of these indicators will be denied unless Medicaid has instructed differently through provider bulletins and/or manuals.
This modifier must only be used on procedures which have a PT/TC indicator equal to 1 or 7 on the Medicare Physician Fee Schedule Relative Value file. Any procedure billed to Medicaid that has been assigned either indicator will continue to process as normal.
Complete definitions of the PC/TC indicators are available on the CMS website. Once within the document, perform a word search for MPFSDB Record Layouts and look for the particular year in question (such as 2008, 2009).",
                "invalid_combinations" => ["26", "50", "62", "66"]
            ],
            [
                "modifier" => "TD",
                "special_coding_instructions" => "The following local policies established modifier TD as appropriate for use with code T1000.
E2008-007 (Changes to HCBS-TA Waiver/Attendant Care for Independent Living [ACIL])
E2009-027 (HCBS-MR/DD Specialized Medical Care Service)
E2010-030 (MFP-MR/DD Specialized Medical Care Service)
KMAP will deny the service if this modifier is billed with any code other than codes 99201 – 99205, 99211 – 99215, 99381 – 99385, 99391 – 99395, or T1000.
For further information, refer to the following provider manuals: General Benefits Provider Manual, RHC-FQHC Provider Manual, HCBS Technology Assisted Provider Manual, and HCBS Mental Retardation or Other Developmental Disability Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TE",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TF",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TG",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TH",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TJ",
                "special_coding_instructions" => "The local policy E2003-047 (Non-Coverage of CMHC, MH Local Codes) established modifier TJ as appropriate for use with codes H2017 and S5110. KMAP will deny the service if this modifier is billed with any code other than H2017 and S5110.
For further information, refer to the Non-PAHP Outpatient Mental Health Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TK",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier. (This modifier is to be used only by the NEMT broker. KMAP will deny the service if this modifier is billed by any other entity.)",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TL",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TM",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TN",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TP",
                "special_coding_instructions" => "Modifiers TP and TQ can be used on procedure codes A0021 – A0999. KMAP will deny the service if these modifiers are billed with any code other than those listed previously.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TR",
                "special_coding_instructions" => "For further information, refer to the Head Start Facility Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TS",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TT",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TU",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TV",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "TW",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U1",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U2",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U3",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for these modifiers.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U4",
                "special_coding_instructions" => "Modifier U4 can be used with code T2046 to indicate a hospice reserve bed day. Reserve bed days are paid at 67% and are limited to 10 days per confinement. KMAP will deny the service if this modifier is billed with any code other than T2046.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U5",
                "special_coding_instructions" => "Modifier U5 can be used on code T1017, when appropriate. KMAP will deny the service if this modifier is billed with any other code. For further information, refer to the Targeted Case Management – Frail Elderly Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U6",
                "special_coding_instructions" => "Modifier U6 can be used on codes T1017, S5125, or S5126, when appropriate. KMAP will deny the service if this modifier is billed with any other codes.
For further information, refer to the HCBS Physical Disability Provider Manual or HCBS Traumatic Brain Injury Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U7",
                "special_coding_instructions" => "Modifier U7 can be used on code T1017, when appropriate. KMAP will deny the service if this modifier is billed with any other code.
For further information, refer to the Money Follows the Person Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U8",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "U9",
                "special_coding_instructions" => "Modifier U9 can be used on codes S5125 or S5126, when appropriate. KMAP will deny the service if these modifiers are billed with any other codes.
For further information, refer to the HCBS Physical Disability Provider Manual or HCBS Traumatic Brain Injury Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UA",
                "special_coding_instructions" => "Modifier UA can be used with code S5125, when appropriate, for Attendant Care Services for HCBS Frail Elderly beneficiaries in assisted living facilities, residential health care facilities, and home plus settings and for MFP Frail Elderly beneficiaries in assisted living settings. KMAP will deny the service if this modifier is billed with any other code.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UB",
                "special_coding_instructions" => "Modifier UB can be used on codes T1017, S5125, or S5126, when appropriate. KMAP will deny the service if this modifier is billed with any other codes.
For further information, refer to the Targeted Case Management – Traumatic Brain Injury Provider Manual, HCBS Physical Disability Provider Manual, or HCBS Traumatic Brain Injury Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UC",
                "special_coding_instructions" => "Modifier UC can be used on code S5126, when appropriate. KMAP will deny the service if this modifier is billed with any other code.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UD",
                "special_coding_instructions" => "Modifier UD can be used on codes S5125 or S5135, when appropriate. KMAP will deny the service if this modifier is billed with any codes other than S5125 or S5135.
For further information, refer to the HCBS Frail Elderly Provider Manual.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UE",
                "special_coding_instructions" => "KMAP uses the Medicare Durable Medical Equipment, Prosthetics/Orthotics & Supplies Fee Schedule to determine which procedures are appropriately billed with modifier UE.
Applicable procedure codes appear on the file with modifier UE (such as A4611 UE). Any procedure not listed with modifier UE will be denied by KMAP.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UF",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UG",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UH",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UJ",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UK",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier. (This modifier is to be used only by the NEMT broker. KMAP will deny the service if this modifier is billed by any other entity.)",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UN",
                "special_coding_instructions" => "Use modifiers UN, UP, UQ, UR, and US with code R0075, when appropriate.
The units field must reflect 1 except in extremely unusual circumstances. The units field must never be used to report the number of patients served during a single trip. The units field must reflect the number of services the specific beneficiary received, not the number of services received by other beneficiaries. KMAP will deny the service if these modifiers are billed with any code other than R0075.
Note: If only one patient is seen at a particular location, report code R0070 without a modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UP",
                "special_coding_instructions" => "Use modifiers UN, UP, UQ, UR, and US with code R0075, when appropriate.
The units field must reflect 1 except in extremely unusual circumstances. The units field must never be used to report the number of patients served during a single trip. The units field must reflect the number of services the specific beneficiary received, not the number of services received by other beneficiaries. KMAP will deny the service if these modifiers are billed with any code other than R0075.
Note: If only one patient is seen at a particular location, report code R0070 without a modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UQ",
                "special_coding_instructions" => "Use modifiers UN, UP, UQ, UR, and US with code R0075, when appropriate.
The units field must reflect 1 except in extremely unusual circumstances. The units field must never be used to report the number of patients served during a single trip. The units field must reflect the number of services the specific beneficiary received, not the number of services received by other beneficiaries. KMAP will deny the service if these modifiers are billed with any code other than R0075.
Note: If only one patient is seen at a particular location, report code R0070 without a modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "UR",
                "special_coding_instructions" => "Use modifiers UN, UP, UQ, UR, and US with code R0075, when appropriate.
The units field must reflect 1 except in extremely unusual circumstances. The units field must never be used to report the number of patients served during a single trip. The units field must reflect the number of services the specific beneficiary received, not the number of services received by other beneficiaries. KMAP will deny the service if these modifiers are billed with any code other than R0075.
Note: If only one patient is seen at a particular location, report code R0070 without a modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "US",
                "special_coding_instructions" => "Use modifiers UN, UP, UQ, UR, and US with code R0075, when appropriate.
The units field must reflect 1 except in extremely unusual circumstances. The units field must never be used to report the number of patients served during a single trip. The units field must reflect the number of services the specific beneficiary received, not the number of services received by other beneficiaries. KMAP will deny the service if these modifiers are billed with any code other than R0075.
Note: If only one patient is seen at a particular location, report code R0070 without a modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "V5",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "V6",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "V7",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "V8",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "V9",
                "special_coding_instructions" => "At this time, there are no special coding instructions applicable to Medicaid claims billing for this modifier.",
                "invalid_combinations" => []
            ],
            [
                "modifier" => "VP",
                "special_coding_instructions" => "This modifier is informational only and can be submitted with the following service categories: Medical Care, Surgery, Consultation, Diagnostic Radiology, Anesthesia, Assistant at Surgery, Other Medical Items or Services, Ambulatory Surgical Center, and Facility Usage for Surgical Services.",
                "invalid_combinations" => []
            ]
        ];

        foreach ($modifiers as $modifier) {
            $mod = Modifier::firstOrCreate([
                'modifier'                    => $modifier['modifier'],
                'special_coding_instructions' => $modifier['special_coding_instructions'],
                'start_date'                  => '1990-05-04',
                'active'                      => true,                
            ]);

            if (isset($modifier['invalid_combinations'])) {
                foreach ($modifier['invalid_combinations'] as $invalid) {
                    ModifierInvalidCombination::firstOrcreate([
                        "modifier_id"  => $mod->id,
                        "invalid_combination" =>  $invalid
                    ]);
                }
            }
        }
    }
}
