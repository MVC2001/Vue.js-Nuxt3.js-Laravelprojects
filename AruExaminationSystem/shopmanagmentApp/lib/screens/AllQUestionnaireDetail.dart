import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shopmanagmentapp/screens/AllQuestionnaireDetail.dart';
import 'package:shopmanagmentapp/screens/QAssureDashboard.dart';

void main() {
  runApp(MaterialApp(
    home: AllQuestionnaire(),
  ));
}

class AllQuestionnaire extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Questionnaires'),
        backgroundColor: Colors.teal,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => QAssureDashboard()),
            );
          },
        ),
      ),
      backgroundColor: Colors.tealAccent,
      body: QuestionnaireTable(),
    );
  }
}

class QuestionnaireTable extends StatefulWidget {
  @override
  _QuestionnaireTableState createState() => _QuestionnaireTableState();
}

class _QuestionnaireTableState extends State<QuestionnaireTable> {
  List<Map<String, dynamic>> _data = [];
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _fetchData();
  }

  Future<void> _fetchData() async {
    final response = await http.get(Uri.parse('http://localhost/AruExaminationSystem/aruexamsapplicationv1/apis/allQuestionnare.php'));

    if (response.statusCode == 200) {
      final List<dynamic> data = json.decode(response.body);
      setState(() {
        _data = data.map((e) => e as Map<String, dynamic>).toList();
        _isLoading = false;
      });
    } else {
      throw Exception('Failed to load data');
    }
  }

  @override
  Widget build(BuildContext context) {
    return _isLoading
        ? Center(child: CircularProgressIndicator())
        : SingleChildScrollView(
      scrollDirection: Axis.vertical,
      child: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        child: Column(
          children: _data.map((item) {
            return Card(
              margin: EdgeInsets.all(10),
              child: Padding(
                padding: EdgeInsets.all(10),
                child: DataTable(
                  columns: [
                    DataColumn(label: Text('Evaluator Name')),
                    DataColumn(label: Text('Date')),
                    DataColumn(label: Text('Course Code')),

                    DataColumn(label: Text('Actions')),
                  ],
                  rows: [
                    DataRow(cells: [
                      DataCell(Text(item['evaluatorsName'] ?? '')),
                      DataCell(Text(item['date'] ?? '')),
                      DataCell(Text(item['courseCode'] ?? '')),
                      DataCell(
                        ElevatedButton(
                          child: Text('View More'),
                          onPressed: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                builder: (context) => AllQuestionnaireDetail(item: item),
                              ),
                            );
                          },
                        ),
                      ),
                    ]),
                  ],
                ),
              ),
            );
          }).toList(),
        ),
      ),
    );
  }

  void _editItem(Map<String, dynamic> item) {
    // Handle item edit here
    print('Editing item: ${item['evaluatorsName']}');
  }
}

class AllQuestionnaireDetail extends StatelessWidget {
  final Map<String, dynamic> item;

  AllQuestionnaireDetail({required this.item});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Questionnaire Details'),
        backgroundColor: Colors.blue,
      ),
      backgroundColor: Colors.blue,
      body: SingleChildScrollView(
        padding: EdgeInsets.all(10),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Evaluator Name: ${item['evaluatorsName'] ?? ''}'),
            Text('Date: ${item['date'] ?? ''}'),
            Text('Course Code: ${item['courseCode'] ?? ''}'),
            Text('Program: ${item['program'] ?? ''}'),
            Text('Reason For: ${item['reasonFor'] ?? ''}'),
            Text('Venue No: ${item['venueNo'] ?? ''}'),
            Text('No Of Admitted Students: ${item['NoOfAdmittedStudents']?.toString() ?? ''}'),
            Text('Exams Room Capacity: ${item['examsRoomCapacity']?.toString() ?? ''}'),
            Text('Name: ${item['name'] ?? ''}'),
            Text('All Students Identified At Entry: ${item['allStudentsIdentifiedAtEntry'] ?? ''}'),
            Text('Students Found With ID: ${item['studentsFoundWithId'] ?? ''}'),
            Text('Students Found With Expired ID: ${item['studentsFoundWithExpiredId'] ?? ''}'),
            Text('Students Found With Forged ID: ${item['studentsFoundWithForgedId'] ?? ''}'),
            Text('Students Found Without ARU ID: ${item['studentsFoundWithoutARUId'] ?? ''}'),
            Text('Students Found With PR/PdUP Permission: ${item['studentsFoundWithpRPdUPpermission'] ?? ''}'),
            Text('Students Found With Police Report: ${item['studentsFoundWithPoliceReport'] ?? ''}'),
            Text('Reason For Quality Assessment: ${item['reasonForQualityAssessment'] ?? ''}'),
            Text('Restriction Of Unauthorized Material: ${item['restrictionOfUnauthorizedMaterial'] ?? ''}'),
            Text('Were Corrections Made To Exams Paper: ${item['wereCorrectionsMadeToExamsPaper'] ?? ''}'),
            Text('Commitment Of Inv: ${item['commitmentOfInv'] ?? ''}'),
            Text('General Conduct Of UE: ${item['generalConductOfUE'] ?? ''}'),
            Text('Good Or Bad On Practices Observed: ${item['godOrBadOnPracticesObserved'] ?? ''}'),
            Text('Recommendation: ${item['recommendation'] ?? ''}'),
            Text('Sitting Arr Of Students: ${item['sittingArrOfStudents'] ?? ''}'),
            Text('Chairs And Tables: ${item['chairsAndTables'] ?? ''}'),
            Text('Room Ventilation: ${item['roomVentilation'] ?? ''}'),
          ],
        ),
      ),
    );
  }
}
