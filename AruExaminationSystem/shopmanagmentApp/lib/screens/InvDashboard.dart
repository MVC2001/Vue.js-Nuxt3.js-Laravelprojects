import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shopmanagmentapp/screens/LoginPage.dart';
import 'package:shopmanagmentapp/screens/SearchScripts.dart';

void main() => runApp(const InvDashboard());

class InvDashboard extends StatelessWidget {
  const InvDashboard({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'INVIGILATOR PANEL',
      home: MyHomePage(title: 'Search assigned booklets and scripts here'),
    );
  }
}

class MyHomePage extends StatelessWidget {
  final String title;

  const MyHomePage({Key? key, required this.title}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(title),
        backgroundColor: Colors.tealAccent,
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            SearchForm(title: 'Search Assigned Booklets', searchUrl: 'http://localhost/AruExaminationSystem/aruexamsapplicationv1/apis/searchAssignedBookltes.php'),
            SizedBox(height: 20),
            SearchForm(title: 'Search Assigned Scripts', searchUrl: 'http://localhost/AruExaminationSystem/aruexamsapplicationv1/apis/searchAssignedScripts.php'),
          ],
        ),
      ),
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.all(0),
          children: [
            DrawerHeader(
              decoration: BoxDecoration(color: Colors.tealAccent),
              child: UserAccountsDrawerHeader(
                decoration: BoxDecoration(color: Colors.tealAccent),
                accountName: Text("ARU APP", style: TextStyle(fontSize: 18)),
                accountEmail: Text("nyemamudhhir@gmal.com"),
                currentAccountPictureSize: Size.square(50),
              ),
            ),
            ListTile(
              leading: Icon(Icons.search),
              title: Text('Create-InvReport'),
              onTap: () {
                Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) {
                  return SearchScripts(title: 'Create invigilation report here',);
                }));
              },
            ),
            ListTile(
              leading: Icon(Icons.logout),
              title: Text('LogOut'),
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

class SearchForm extends StatefulWidget {
  final String title;
  final String searchUrl;

  const SearchForm({Key? key, required this.title, required this.searchUrl}) : super(key: key);

  @override
  _SearchFormState createState() => _SearchFormState();
}

class _SearchFormState extends State<SearchForm> {
  final TextEditingController _fullNameController = TextEditingController();
  final TextEditingController _createdAtController = TextEditingController();
  List<Map<String, dynamic>> _data = [];
  bool _isLoading = false;

  Future<void> _fetchData() async {
    final fullName = _fullNameController.text;
    final createdAt = _createdAtController.text;
    final url = Uri.parse('${widget.searchUrl}?fullName=$fullName&created_at=$createdAt');

    setState(() {
      _isLoading = true;
    });

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final List<dynamic> data = json.decode(response.body);
      setState(() {
        _data = data.map((e) => e as Map<String, dynamic>).toList();
        _isLoading = false;
      });
    } else {
      setState(() {
        _isLoading = false;
      });
      throw Exception('Failed to load data');
    }
  }

  Future<void> _confirmScript(int scriptId) async {
    final url = Uri.parse('http://localhost/AruExaminationSystem/aruexamsapplicationv1/apis/confirmScript.php');
    final response = await http.post(url, body: {'script_id': scriptId.toString()});

    if (response.statusCode == 200) {
      final result = json.decode(response.body);
      if (result['status'] == 'success') {
        _fetchData();
      } else {
        throw Exception(result['message']);
      }
    } else {
      throw Exception('Failed to confirm script');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.all(16.0),
      child: Column(
        children: [
          Text(widget.title, style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
          SizedBox(height: 20),
          Row(
            children: [
              Expanded(
                child: TextField(
                  controller: _fullNameController,
                  decoration: InputDecoration(labelText: 'Full Name'),
                ),
              ),
              SizedBox(width: 16),
              Expanded(
                child: TextField(
                  controller: _createdAtController,
                  decoration: InputDecoration(labelText: 'Created At (YYYY-MM-DD)'),
                ),
              ),
            ],
          ),
          SizedBox(height: 20),
          ElevatedButton(
            onPressed: _fetchData,
            child: Text('Search'),
          ),
          SizedBox(height: 20),
          _isLoading
              ? CircularProgressIndicator()
              : _data.isEmpty
              ? Text('No data found')
              : SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: DataTable(
              columns: [
                DataColumn(label: Text('Full Name')),
                DataColumn(label: Text('Quantity')),
                DataColumn(label: Text('Description')),
                DataColumn(label: Text('Created At')),
                DataColumn(label: Text('Confirmation')),
                DataColumn(label: Text('Action')),
              ],
              rows: _data.map((item) {
                return DataRow(cells: [
                  DataCell(Text(item['fullName'] ?? '')),
                  DataCell(Text(item['quantity'].toString())),
                  DataCell(Text(item['description'] ?? '')),
                  DataCell(Text(item['created_at'] ?? '')),
                  DataCell(Text(item['confirmation'] ?? '')),
                  DataCell(
                    item['confirmation'] == 'confirmed'
                        ? Text('Confirmed')
                        : ElevatedButton(
                      onPressed: () => _confirmScript(item['script_id']),
                      child: Text('Confirm'),
                    ),
                  ),
                ]);
              }).toList(),
            ),
          ),
        ],
      ),
    );
  }
}
