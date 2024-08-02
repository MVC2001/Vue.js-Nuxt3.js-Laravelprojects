import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shopmanagmentapp/screens/AllQUestionnaireDetail.dart';
import 'package:shopmanagmentapp/screens/LoginPage.dart';
import 'package:shopmanagmentapp/screens/PasswordReset.dart';


void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: QAssureDashboard(),
  ));
}

class QAssureDashboard extends StatefulWidget {
  const QAssureDashboard({Key? key});

  @override
  State<QAssureDashboard> createState() => _DashboardState();
}

class _DashboardState extends State<QAssureDashboard> {
  String? selectedYearOfStudy;
  String? selectedSchool;
  String? selectedDept;
  DateTime? departingDate;
  DateTime? returningDate;
  bool dataSuccessfullyRegistered = false;

  TextEditingController controllerEvaluatorsName = TextEditingController();
  TextEditingController controllerDate = TextEditingController();
  TextEditingController controllerCourseCode = TextEditingController();
  TextEditingController controllerProgram = TextEditingController();
  TextEditingController controllerdepartingOn = TextEditingController();
  TextEditingController controllerreturningOn = TextEditingController();
  TextEditingController controllerReasonFor = TextEditingController();
  TextEditingController controllerVenueNo = TextEditingController();
  TextEditingController controllerNoOfAdmittedStudents = TextEditingController();
  TextEditingController controllerExamsRoomCapacity = TextEditingController();
  TextEditingController controllerInvName = TextEditingController();
  TextEditingController controllerInvRank = TextEditingController();
  TextEditingController allStudentsIdentifiedAtEntryController = TextEditingController();
  TextEditingController studentsFoundWithIdController = TextEditingController();
  TextEditingController studentsFoundWithExpiredIdController = TextEditingController();
  TextEditingController studentsFoundWithForgedIdController = TextEditingController();
  TextEditingController studentsFoundWithoutARUIdController = TextEditingController();
  TextEditingController studentsFoundWithpRPdUPpermissionController = TextEditingController();
  TextEditingController studentsFoundWithPoliceReportController = TextEditingController();
  TextEditingController reasonForQualityAssessmentController = TextEditingController();
  TextEditingController controllerRestrictionOfUnauthorizedMaterial = TextEditingController();
  TextEditingController wereCorrectionsMadeToExamsPaperController = TextEditingController();
  TextEditingController controllerCommitmentOfInv = TextEditingController();
  TextEditingController generalConductOfUEController = TextEditingController();
  TextEditingController godOrBadOnPracticesObbservedController = TextEditingController();
  TextEditingController recommendationController = TextEditingController();
  TextEditingController controllerSittingArrOfStudents = TextEditingController();
  TextEditingController controllerChairsAndTables = TextEditingController();
  TextEditingController controllerRoomVentilation = TextEditingController();


  final _formKey = GlobalKey<FormState>();

  List<String> startingAtOptions = [
    'Started on time',
    'Started late between 1 to 10 min',
    'Started late between 10 to 20 min',
    'Started late between 20 to 30 min',
    'Started late more than 30 min',
    'Examination postponed',
  ];

  List<String> performanceLevels = [
    'very_poor',
    'poor',
    'good',
    'very_good',
    'excellent',
  ];
  List<String> chairsAndTablesOptions = [
    'very_poor',
    'poor',
    'good',
    'very_good',
    'excellent',
  ];

  List<String> sittingArrOfStudents = [
    'very_poor',
    'poor',
    'good',
    'very_good',
    'excellent',
  ];

  List<String> roomVentilation = [
    'very_poor',
    'poor',
    'good',
    'very_good',
    'excellent',
  ];

  List<String> invRankOptions = [
    "Professor",
    "Senior Lecturer",
    "Lecturer",
    "Assistant Lecturer",
    "Tutorial Assistant",
    "Non-academic",
  ];

  String? selectedStartingAt;
  String? studentPerformanceLevel;
  String? selectedSittingArrangement;
  String? selectedChairsAndTables; // Added variable for ChairsAndTables
  String? selectedRoomVentilation; // Added variable for RoomVentilation

  bool _loading = false;

  void _showToast(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        duration: Duration(seconds: 2),
      ),
    );
  }

  Future<void> sentRequest() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    var url = Uri.parse("http://127.0.0.1/AruExaminationSystem/aruexamsapplicationv1/apis/addQuestionnaire.php");

    setState(() {
      _loading = true;
    });

    try {
      var response = await http.post(url, body: {
        // Add the new fields to the request body
        "evaluatorsName": controllerEvaluatorsName.text,
        "date": controllerDate.text,
        "courseCode": controllerCourseCode.text,
        "program": controllerProgram.text,
        "reasonFor": controllerReasonFor.text,
        "venueNo": controllerVenueNo.text,
        "NoOfAdmittedStudents": controllerNoOfAdmittedStudents.text,
        "examsRoomCapacity": controllerExamsRoomCapacity.text,
        "name": controllerInvName.text,
        "invRank": controllerInvRank.text,
        "allStudentsIdentifiedAtEntry": allStudentsIdentifiedAtEntryController.text, // Add allStudentsIdentifiedAtEntry
        "studentsFoundWithId": studentsFoundWithIdController.text, // Add studentsFoundWithId
        "studentsFoundWithExpiredId": studentsFoundWithExpiredIdController.text, // Add studentsFoundWithExpiredId
        "studentsFoundWithForgedId": studentsFoundWithForgedIdController.text, // Add studentsFoundWithForgedId
        "studentsFoundWithoutARUId": studentsFoundWithoutARUIdController.text, // Add studentsFoundWithoutARUId
        "studentsFoundWithpRPdUPpermission": studentsFoundWithpRPdUPpermissionController.text, // Add studentsFoundWithpRPdUPpermission
        "studentsFoundWithPoliceReport": studentsFoundWithPoliceReportController.text, // Add studentsFoundWithPoliceReport
        "reasonForQualityAssessment": reasonForQualityAssessmentController.text, // Add reasonForQualityAssessment
        "restrictionOfUnauthorizedMaterial": controllerRestrictionOfUnauthorizedMaterial.text, // Add restrictionOfUnauthorizedMaterial
        "wereCorrectionsMadeToExamsPaper": wereCorrectionsMadeToExamsPaperController.text, // Add wereCorrectionsMadeToExamsPaper
        "commitmentOfInv": controllerCommitmentOfInv.text, // Add commitmentOfInv
        "generalConductOfUE": generalConductOfUEController.text, // Add generalConductOfUE
        "godOrBadOnPracticesObserved": godOrBadOnPracticesObbservedController.text, // Add godOrBadOnPracticesObserved
        "recommendation": recommendationController.text, // Add recommendation
        "sittingArrOfStudents": controllerSittingArrOfStudents.text,
        "chairsAndTables": controllerChairsAndTables.text,
        "roomVentilation": controllerRoomVentilation.text,
        // Rest of the fields remain the same
      });

      if (response.statusCode == 200) {
        var responseData = response.body;
        if (responseData == 'detail already exist') {
          _showToast('detail already exists');
        } else if (responseData == 'New detail have been sent successfully') {
          setState(() {
            dataSuccessfullyRegistered = true;
          });
          _showToast('New detail added successfully');
        } else {
          _showToast('Error: $responseData');
        }
      } else {
        throw Exception('Failed to add data');
      }
    } catch (e) {
      print('Error: $e');
      setState(() {
        dataSuccessfullyRegistered = false;
      });
      _showToast('Failed to add data. Please try again.');
    } finally {
      setState(() {
        _loading = false;
      });
    }
  }


  Future<void> _selectSubmissionDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(1900),
      lastDate: DateTime.now(),
    );
    if (picked != null) {
      setState(() {
        controllerDate.text = picked.toString();
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Questionnaire to monitor the conduct of UE'),
        centerTitle: true,
        backgroundColor: Colors.white,
      ),
      body: SafeArea(
        child: Center(
          child: Card(
            elevation: 0.0,
            color: Colors.white,
            margin: EdgeInsets.all(20),
            child: Padding(
              padding: EdgeInsets.all(20),
              child: Form(
                key: _formKey,
                child: Column(
                  children: <Widget>[
                    Expanded(
                      child: ListView(
                        shrinkWrap: true,
                        children: <Widget>[
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              SizedBox(height: 2),
                              Text(
                                'Fill this form below',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 18,
                                  fontFamily: 'Netflix',
                                  color: Colors.blueGrey,

                                ),
                              ),
                              SizedBox(height: 10),
                              Text(
                                '1. General information',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 18,
                                  fontFamily: 'Netflix',
                                ),
                              ),
                              SizedBox(height: 20),
                              Row(
                                children: [
                                  Expanded(
                                    flex: 6,
                                    child: TextFormField(
                                      controller: controllerEvaluatorsName,
                                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                      decoration: InputDecoration(
                                        hintText: "Enter Evaluator's Name",
                                        labelText: "Evaluator's Name*",
                                        hintStyle: TextStyle(fontFamily: "Netflix"),
                                        labelStyle: TextStyle(fontFamily: "Netflix"),
                                      ),
                                      validator: (value) {
                                        if (value == null || value.isEmpty) {
                                          return 'Please enter evaluator\'s name';
                                        }
                                        return null;
                                      },
                                    ),
                                  ),
                                  SizedBox(width: 10),
                                  Expanded(
                                    flex: 6,
                                    child: TextFormField(
                                      controller: controllerDate,
                                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                      decoration: InputDecoration(
                                        hintText: "Select Date",
                                        labelText: "Date*",
                                        hintStyle: TextStyle(fontFamily: "Netflix"),
                                        labelStyle: TextStyle(fontFamily: "Netflix"),
                                      ),
                                      validator: (value) {
                                        return null;
                                      },
                                      onTap: () {
                                        _selectSubmissionDate(context);
                                      },
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(height: 10),
                              Row(
                                children: [
                                  Expanded(
                                    flex: 6,
                                    child: TextFormField(
                                      controller: controllerCourseCode,
                                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                      decoration: InputDecoration(
                                        hintText: "Enter Course Code",
                                        labelText: "Course Code*",
                                        hintStyle: TextStyle(fontFamily: "Netflix"),
                                        labelStyle: TextStyle(fontFamily: "Netflix"),
                                      ),
                                      validator: (value) {
                                        return null;
                                      },
                                    ),
                                  ),
                                  SizedBox(width: 10),
                                  Expanded(
                                    flex: 6,
                                    child: TextFormField(
                                      controller: controllerProgram,
                                      style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                      decoration: InputDecoration(
                                        hintText: "Enter Program",
                                        labelText: "Program*",
                                        hintStyle: TextStyle(fontFamily: "Netflix"),
                                        labelStyle: TextStyle(fontFamily: "Netflix"),
                                      ),
                                      validator: (value) {
                                        return null;
                                      },
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(height: 20),
                              Text(
                                '2. Examination Starting Time',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                  fontFamily: 'Netflix',
                                ),
                              ),
                              SizedBox(height: 10),
                              DropdownButtonFormField<String>(
                                value: selectedStartingAt,
                                onChanged: (value) {
                                  setState(() {
                                    selectedStartingAt = value;
                                  });
                                },
                                items: startingAtOptions.map((option) {
                                  return DropdownMenuItem<String>(
                                    value: option,
                                    child: Text(option),
                                  );
                                }).toList(),
                                decoration: InputDecoration(
                                  hintText: "Select Examination Starting Time",
                                  labelText: "Examination Starting Time*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please select Examination Starting Time';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 10),
                              TextFormField(
                                controller: controllerReasonFor,
                                maxLines: null,
                                style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                decoration: InputDecoration(
                                  hintText: "Enter Reason",
                                  labelText: "Reason*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please enter reason';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 20),
                              Text(
                                '3. Examination Venue',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                  fontFamily: 'Netflix',
                                ),
                              ),
                              SizedBox(height: 10),
                              TextFormField(
                                controller: controllerVenueNo,
                                style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                decoration: InputDecoration(
                                  hintText: "Enter Venue No",
                                  labelText: "Venue No*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please enter venue number';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 10),
                              TextFormField(
                                controller: controllerNoOfAdmittedStudents,
                                style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                decoration: InputDecoration(
                                  hintText: "Enter No of Admitted Students",
                                  labelText: "No of Admitted Students*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please enter number of admitted students';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 10),
                              TextFormField(
                                controller: controllerExamsRoomCapacity,
                                style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                decoration: InputDecoration(
                                  hintText: "Enter Exams Room Capacity",
                                  labelText: "Exams Room Capacity*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please enter exams room capacity';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 20),
                              Text(
                                '3.2. Sitting Arrangement of Students',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                  fontFamily: 'Netflix',
                                ),
                              ),
                              SizedBox(height: 10),
                              DropdownButtonFormField<String>(
                                value: controllerChairsAndTables.text.isNotEmpty ? controllerChairsAndTables.text : null,
                                onChanged: (value) {
                                  setState(() {
                                    controllerChairsAndTables.text = value!;
                                  });
                                },
                                items: chairsAndTablesOptions.map((level) {
                                  return DropdownMenuItem<String>(
                                    value: level,
                                    child: Text(level),
                                  );
                                }).toList(),
                                decoration: InputDecoration(
                                  hintText: "Select Chairs And Tables",
                                  labelText: "Chairs And Tables*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please select Chairs And Tables';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 20,),
                              DropdownButtonFormField<String>(
                                value: selectedSittingArrangement,
                                onChanged: (String? value) { // Ensure that value is of type String?
                                  setState(() {
                                    selectedSittingArrangement = value ?? ''; // Use null-aware operator ?? to provide a default value
                                    controllerSittingArrOfStudents.text = value ?? ''; // Use null-aware operator ?? to provide a default value
                                  });
                                },
                                items: sittingArrOfStudents.map((level) {
                                  return DropdownMenuItem<String>(
                                    value: level,
                                    child: Text(level),
                                  );
                                }).toList(),
                                decoration: InputDecoration(
                                  hintText: "Select Sitting Arrangement of Students",
                                  labelText: "Sitting Arrangement of Students*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please select Sitting Arrangement of Students';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 20),
                              Text(
                                '3.4. Room Ventilation',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                  fontFamily: 'Netflix',
                                ),
                              ),
                              SizedBox(height: 10),
                              DropdownButtonFormField<String>(
                                value: selectedRoomVentilation,
                                onChanged: (String? value) {
                                  setState(() {
                                    selectedRoomVentilation = value ?? '';
                                    controllerRoomVentilation.text = value ?? '';
                                  });
                                },
                                items: performanceLevels.map((level) {
                                  return DropdownMenuItem<String>(
                                    value: level,
                                    child: Text(level),
                                  );
                                }).toList(),
                                decoration: InputDecoration(
                                  hintText: "Select Room Ventilation",
                                  labelText: "Room Ventilation*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please select Room Ventilation';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 20),
                              Text(
                                '4. Invigilator Information',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                  fontFamily: 'Netflix',
                                ),
                              ),
                              SizedBox(height: 10),
                              TextFormField(
                                controller: controllerInvName,
                                style: TextStyle(fontFamily: "Netflix", fontSize: 15),
                                decoration: InputDecoration(
                                  hintText: "Enter Invigilator Name",
                                  labelText: "Invigilator's Name*",
                                  hintStyle: TextStyle(fontFamily: "Netflix"),
                                  labelStyle: TextStyle(fontFamily: "Netflix"),
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please enter invigilator\'s name';
                                  }
                                  return null;
                                },
                              ),
                              SizedBox(height: 10),
                              TextFormField(
                                controller: controllerInvRank,
                                decoration: InputDecoration(
                                  labelText: "Invigilator's Rank",
                                  hintText: "Select Invigilator's Rank",
                                ),
                                readOnly: true,
                                onTap: () {
                                  showDialog(
                                    context: context,
                                    builder: (BuildContext context) {
                                      return AlertDialog(
                                        title: Text("Select Invigilator's Rank"),
                                        content: DropdownButtonFormField<String>(
                                          value: controllerInvRank.text.isNotEmpty ? controllerInvRank.text : null,
                                          onChanged: (value) {
                                            setState(() {
                                              controllerInvRank.text = value!;
                                              Navigator.of(context).pop();
                                            });
                                          },
                                          items: invRankOptions.map((rank) {
                                            return DropdownMenuItem<String>(
                                              value: rank,
                                              child: Text(rank),
                                            );
                                          }).toList(),
                                          decoration: InputDecoration(
                                            hintText: "Select Invigilator's Rank",
                                            border: OutlineInputBorder(),
                                          ),
                                          validator: (value) {
                                            if (value == null || value.isEmpty) {
                                              return 'Please select invigilator\'s rank';
                                            }
                                            return null;
                                          },
                                        ),
                                      );
                                    },
                                  );
                                },
                              ),
                              SizedBox(height: 10.0,),
                              DropdownButtonFormField<String>(
                                value: allStudentsIdentifiedAtEntryController.text.isNotEmpty ? allStudentsIdentifiedAtEntryController.text : null,
                                onChanged: (value) {
                                  setState(() {
                                    allStudentsIdentifiedAtEntryController.text = value!;
                                  });
                                },
                                items: [
                                  DropdownMenuItem(
                                    value: "Yes",
                                    child: Text("Yes"),
                                  ),
                                  DropdownMenuItem(
                                    value: "No",
                                    child: Text("No"),
                                  ),
                                ],
                                decoration: InputDecoration(
                                  hintText: "Select Option",
                                  labelText: "Were All students Identified at the entry?*",
                                ),
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    return 'Please choose an option';
                                  }
                                  return null;
                                },
                              ),
                            ],
                          ),
                          SizedBox(height: 10.0,),
                          Column(
                            children: [
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: studentsFoundWithIdController,
                                      decoration: InputDecoration(
                                        labelText: "Students Found with ID",
                                        hintText: "Enter number",
                                      ),
                                      keyboardType: TextInputType.number,
                                    ),
                                  ),
                                  Expanded(
                                    child: TextFormField(
                                      controller: studentsFoundWithExpiredIdController,
                                      decoration: InputDecoration(
                                        labelText: "Students Found with Expired ID",
                                        hintText: "Enter number",
                                      ),
                                      keyboardType: TextInputType.number,
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: studentsFoundWithForgedIdController,
                                      decoration: InputDecoration(
                                        labelText: "Students Found with Forged ID",
                                        hintText: "Enter number",
                                      ),
                                      keyboardType: TextInputType.number,
                                    ),
                                  ),
                                  Expanded(
                                    child: TextFormField(
                                      controller: studentsFoundWithoutARUIdController,
                                      decoration: InputDecoration(
                                        labelText: "Students Found without ARU ID",
                                        hintText: "Enter number",
                                      ),
                                      keyboardType: TextInputType.number,
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: studentsFoundWithpRPdUPpermissionController,
                                      decoration: InputDecoration(
                                        labelText: "Students Found with PRP/DUP Permission",
                                        hintText: "Enter number",
                                      ),
                                      keyboardType: TextInputType.number,
                                    ),
                                  ),
                                  Expanded(
                                    child: TextFormField(
                                      controller: studentsFoundWithPoliceReportController,
                                      decoration: InputDecoration(
                                        labelText: "Students Found with Police Report Permission",
                                        hintText: "Enter number",
                                      ),
                                      keyboardType: TextInputType.number,
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: reasonForQualityAssessmentController,
                                      decoration: InputDecoration(
                                        labelText: "Reason for Quality Assessment",
                                        hintText: "Enter reason",
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(height: 10.0,),
                              Row(
                                children: [
                                  Expanded(
                                    child: Text(" 5.Commitment of examiners",style:
                                    TextStyle(
                                      fontWeight: FontWeight.bold,
                                    ),),
                                  ),
                                ],
                              ),
                              SizedBox(height: 5.0,),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: wereCorrectionsMadeToExamsPaperController,
                                      decoration: InputDecoration(
                                        labelText: "Corrections Made to Exams Paper",
                                        hintText: "Enter corrections",
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: generalConductOfUEController,
                                      decoration: InputDecoration(
                                        labelText: "General Conduct of UE",
                                        hintText: "Enter general conduct of UE",
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: godOrBadOnPracticesObbservedController,
                                      decoration: InputDecoration(
                                        labelText: "Good or Bad Practices Observed",
                                        hintText: "Enter observation",
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: recommendationController,
                                      decoration: InputDecoration(
                                        labelText: "Recommendation",
                                        hintText: "Enter recommendation",
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: TextFormField(
                                      controller: controllerRestrictionOfUnauthorizedMaterial,
                                      decoration: InputDecoration(
                                        labelText: "Restriction of Unauthorized Material",
                                        hintText: "Enter value",
                                      ),
                                    ),
                                  ),
                                  Expanded(
                                    child: TextFormField(
                                      controller: controllerCommitmentOfInv,
                                      decoration: InputDecoration(
                                        labelText: "Commitment of Involvement",
                                        hintText: "Enter value",
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                    SizedBox(height: 17.0,),
                    ElevatedButton(
                      onPressed: () {
                        sentRequest();
                      },
                      child: Text(
                        "Submit now",
                        style: TextStyle(color: Colors.white),
                      ),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.black54,
                      ),
                    ),
                    if (_loading)
                      Center(
                        child: CircularProgressIndicator(),
                      ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
      drawer: Drawer(
        child: ListView(
          padding: const EdgeInsets.all(0),
          children: [
            const DrawerHeader(
              decoration: BoxDecoration(
                color: Colors.tealAccent,
              ),
              child: Text(
                'USER MENU',
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 25.0, color: Colors.teal),
              ),
            ),
            ListTile(
              leading: const Icon(Icons.person),
              title: const Text('Password reset'),
              onTap: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => PasswordReset()),
                );
              },
            ),
            ListTile(
              leading: const Icon(Icons.list),
              title: const Text('Questionnaires info'),
              onTap: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => AllQuestionnaire()),
                );
              },
            ),
            ListTile(
              leading: const Icon(Icons.logout),
              title: const Text('LogOut'),
              onTap: () {
                Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) {
                  return LoginPage();
                }));
              },
            ),
          ],
        ),
      ),
    );
  }
}
