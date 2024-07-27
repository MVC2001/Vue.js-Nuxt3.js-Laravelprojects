import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:fluttertoast/fluttertoast.dart';



void main() {
  runApp(PasswordReset());
}


class PasswordReset extends StatefulWidget {
  @override
  _PasswordResetState createState() => _PasswordResetState();
}

class _PasswordResetState extends State<PasswordReset> {
  TextEditingController emailController = TextEditingController();
  TextEditingController passwordController = TextEditingController();

  bool passwordResetInProgress = false;
  bool passwordResetSuccessful = false;

  Future<void> resetPassword() async {
    setState(() {
      passwordResetInProgress = true;
    });

    var url = Uri.parse("http://127.0.0.1:80/AruExaminationSystem/aruexamsapplicationv1/apis/passReset.php");

    try {
      var response = await http.post(url, body: {
        "email": emailController.text,
        "password": passwordController.text,
      });

      if (response.statusCode == 200) {
        var responseData = response.body;
        if (responseData == 'Password reset successful') {
          setState(() {
            passwordResetSuccessful = true;
            passwordResetInProgress = false;
          });
          Fluttertoast.showToast(
            msg: 'Password reset successful',
            backgroundColor: Colors.green,
            textColor: Colors.white,
            toastLength: Toast.LENGTH_SHORT,
          );
        } else {
          Fluttertoast.showToast(
            backgroundColor: Colors.red,
            textColor: Colors.white,
            msg: responseData,
            toastLength: Toast.LENGTH_SHORT,
          );
          setState(() {
            passwordResetInProgress = false;
          });
        }
      } else {
        throw Exception('Failed to reset password');
      }
    } catch (e) {
      print('Error: $e');
      Fluttertoast.showToast(
        backgroundColor: Colors.red,
        textColor: Colors.white,
        msg: 'Failed to reset password. Please try again.',
        toastLength: Toast.LENGTH_SHORT,
      );
      setState(() {
        passwordResetInProgress = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Password Reset'),
        backgroundColor: Colors.black54,
      ),
      body: Padding(
        padding: const EdgeInsets.all(20.0),
        child: ListView(
          children: <Widget>[
            Card(
              elevation: 4,
              child: Padding(
                padding: const EdgeInsets.all(20.0),
                child: Column(
                  children: <Widget>[
                    TextField(
                      controller: emailController,
                      decoration: InputDecoration(
                        hintText: "Enter Email",
                        labelText: "Email",
                      ),
                    ),
                    SizedBox(height: 20),
                    TextField(
                      controller: passwordController,
                      obscureText: true,
                      decoration: InputDecoration(
                        hintText: "Enter New Password",
                        labelText: "New Password",
                      ),
                    ),
                    SizedBox(height: 20),
                    ElevatedButton(
                      onPressed: () {
                        resetPassword();
                      },
                      child: passwordResetInProgress
                          ? CircularProgressIndicator()
                          : Text("Reset Password"),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.black54,
                      ),
                    ),
                    if (passwordResetSuccessful)
                      Padding(
                        padding: EdgeInsets.symmetric(vertical: 10),
                        child: Text(
                          "Password reset successful",
                          style: TextStyle(
                            color: Colors.green,
                          ),
                        ),
                      ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

// Screen to show when the user is unauthorized
class UnauthorizedScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Text(
          'You are not authorized to access this screen.',
          style: TextStyle(fontSize: 20),
          textAlign: TextAlign.center,
        ),
      ),
    );
  }
}
