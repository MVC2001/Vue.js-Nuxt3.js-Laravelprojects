import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shopmanagmentapp/screens/AllQUestionnaireDetail.dart';
import 'package:shopmanagmentapp/screens/ExamerDashboard.dart';
import 'package:shopmanagmentapp/screens/InvDashboard.dart';
import 'package:shopmanagmentapp/screens/QAssureDashboard.dart';
import 'package:shopmanagmentapp/screens/RegisterPage.dart';


void main() {
  runApp(LoginPage(),
  );
}


class LoginPage extends StatelessWidget {
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();

  Future<void> _login(BuildContext context) async {
    String email = emailController.text;
    String password = passwordController.text;

    try {
      final response = await http.post(
        Uri.parse('http://localhost/AruExaminationSystem/aruexamsapplicationv1/apis/login.php'),
        body: {'email': email, 'password': password},
      );

      if (response.statusCode == 200) {
        print(response.body); // Debugging line to print the raw response body
        Map<String, dynamic> data = json.decode(response.body);
        if (data['status'] == 'success') {
          String role = data['user']['role'];
          if (role == 'quality_assurance_officer') {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => AllQuestionnaire()),
            );
          } else if (role == 'invigilator') {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => InvDashboard()),
            );
          } else if (role == 'examiner') {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => ExamerDashboard()),
            );
          } else {
            _showErrorDialog(context, 'You do not have any permission to access this app');
          }
        } else {
          _showErrorDialog(context, data['message']);
        }
      } else {
        _showErrorDialog(context, 'Failed to connect to server');
      }
    } catch (e) {
      _showErrorDialog(context, 'An error occurred: $e');
    }
  }

  void _showErrorDialog(BuildContext context, String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Error'),
          content: Text(message),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: Text('OK'),
            ),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Login'),
        backgroundColor: Colors.tealAccent,
      ),

      body: Stack(
        children: [
          Positioned.fill(
            child: Image.asset(
              'images/myappimg.png',
              fit: BoxFit.cover,
            ),
          ),
          Padding(
            padding: EdgeInsets.all(16.0),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                TextField(
                  controller: emailController,
                  decoration: InputDecoration(
                    labelText: 'Username',
                    labelStyle: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
                    enabledBorder: UnderlineInputBorder(
                      borderSide: BorderSide(color: Colors.white),
                    ),
                    focusedBorder: UnderlineInputBorder(
                      borderSide: BorderSide(color: Colors.white),
                    ),
                  ),
                  style: TextStyle(color: Colors.white),
                ),
                TextField(
                  controller: passwordController,
                  decoration: InputDecoration(
                    labelText: 'Password',
                    labelStyle: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
                    enabledBorder: UnderlineInputBorder(
                      borderSide: BorderSide(color: Colors.white),
                    ),
                    focusedBorder: UnderlineInputBorder(
                      borderSide: BorderSide(color: Colors.white),
                    ),
                  ),
                  obscureText: true,
                  style: TextStyle(color: Colors.white),
                ),
                SizedBox(height: 20.0),
                ElevatedButton(
                  onPressed: () => _login(context),
                  child: Text(
                    'Login',
                    style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold,),
                  ),
                  style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.tealAccent,
                  ),
                ),
                TextButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => RegisterPage()),
                    );
                  },
                  child: Text(
                    'Don\'t have an account? Register here',
                    style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
