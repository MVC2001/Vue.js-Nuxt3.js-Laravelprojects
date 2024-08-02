import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shopmanagmentapp/screens/InvDashboard.dart';

class SearchScripts extends StatelessWidget {
  final String title;

  const SearchScripts({Key? key, required this.title}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(title),
        backgroundColor: Colors.tealAccent,
        actions: [
          IconButton(
            icon: Icon(Icons.home),
            onPressed: () {
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) => InvDashboard()),
              );
            },
          ),
        ],
      ),
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            DrawerHeader(
              decoration: BoxDecoration(
                color: Colors.tealAccent,
              ),
              child: Text(
                'Menu',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 24,
                ),
              ),
            ),
            ListTile(
              leading: Icon(Icons.arrow_back),
              title: Text('Back Home'),
              onTap: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => InvDashboard()),
                );
              },
            ),
          ],
        ),
      ),
      body: Center(
        child: SearchForm(),
      ),
    );
  }
}

class SearchForm extends StatefulWidget {
  @override
  _SearchFormState createState() => _SearchFormState();
}

class _SearchFormState extends State<SearchForm> {
  final TextEditingController _fullNameController = TextEditingController();
  final TextEditingController _schoolIdController = TextEditingController();
  final TextEditingController _departmentIdController = TextEditingController();
  final TextEditingController _courseCodeController = TextEditingController();
  final TextEditingController _programController = TextEditingController();
  final TextEditingController _totalStudentsController = TextEditingController();
  final TextEditingController _bookletsUsedController = TextEditingController();
  final TextEditingController _unUsedBookletsController = TextEditingController();
  final TextEditingController _usedScriptsController = TextEditingController();
  final TextEditingController _unUsedScriptsController = TextEditingController();
  final TextEditingController _descriptionController = TextEditingController();
  bool _isLoading = false;

  Future<void> _createReport() async {
    final url = Uri.parse('http://localhost/AruExaminationSystem/aruexamsapplicationv1/apis/createReport.php');
    final response = await http.post(url, body: {
      'fullName': _fullNameController.text,
      'school_id': _schoolIdController.text,
      'department_id': _departmentIdController.text,
      'courseCode': _courseCodeController.text,
      'program': _programController.text,
      'totalStudents': _totalStudentsController.text,
      'bookletsUsed': _bookletsUsedController.text,
      'unUsedBooklets': _unUsedBookletsController.text,
      'usedScripts': _usedScriptsController.text,
      'unUsedScripts': _unUsedScriptsController.text,
      'description': _descriptionController.text,
    });

    setState(() {
      _isLoading = false;
    });

    if (response.statusCode == 200) {
      final result = json.decode(response.body);
      if (result['status'] == 'success') {
        Fluttertoast.showToast(
          msg: "New report created successfully",
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.BOTTOM,
        );
      } else {
        Fluttertoast.showToast(
          msg: "Failed to create report: ${result['message']}",
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.BOTTOM,
        );
      }
    } else {
      Fluttertoast.showToast(
        msg: "Failed to create report",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      padding: EdgeInsets.all(16.0),
      child: Column(
        children: [
          _buildTextField(_fullNameController, 'Full Name'),
          _buildTextField(_schoolIdController, 'School ID'),
          _buildTextField(_departmentIdController, 'Department ID'),
          _buildTextField(_courseCodeController, 'Course Code'),
          _buildTextField(_programController, 'Program'),
          _buildTextField(_totalStudentsController, 'Total Students'),
          _buildTextField(_bookletsUsedController, 'Booklets Used'),
          _buildTextField(_unUsedBookletsController, 'UnUsed Booklets'),
          _buildTextField(_usedScriptsController, 'Used Scripts'),
          _buildTextField(_unUsedScriptsController, 'UnUsed Scripts'),
          _buildTextField(_descriptionController, 'Description'),
          SizedBox(height: 20),
          _isLoading
              ? CircularProgressIndicator()
              : ElevatedButton(
            onPressed: () {
              setState(() {
                _isLoading = true;
              });
              _createReport();
            },
            child: Text('Create Report'),
          ),
        ],
      ),
    );
  }

  Widget _buildTextField(TextEditingController controller, String label) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: TextField(
        controller: controller,
        decoration: InputDecoration(
          labelText: label,
          border: OutlineInputBorder(),
        ),
      ),
    );
  }
}

void main() {
  runApp(MaterialApp(
    title: 'Search Scripts',
    home: SearchScripts(title: 'Search Scripts'),
  ));
}
