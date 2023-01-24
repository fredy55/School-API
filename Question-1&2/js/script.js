
//Get students by center
function loadStudents(centerId) {
  $requestUrl = "http://localhost/INTERVIEW/Question-1&2/index.php";

  const xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", $requestUrl);
  xmlhttp.setRequestHeader("X_Requested_With", "xmlhttprequest");

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

        getStudentsByCenter(this);
      }
  };
  xmlhttp.setRequestHeader('Content-Type', 'text/xml');

 let xmlData = `<?xml version='1.0'?>
  <query>
  <type>center</type>
  <page>1</page>
  <per_page>5</per_page>
  <seviceid>${centerId}</seviceid>
  </query>`;

  xmlhttp.send(xmlData);
}


function getStudentsByCenter(xml) {
  const xmlDoc = xml.responseXML;
  const stArray = xmlDoc.getElementsByTagName("student");
  const status = xmlDoc.getElementsByTagName("status")[0].innerHTML;
  console.log(stArray);

  if(status == 'success'){

    var tableData ='<tr><th>Student</th><th>Center</th></tr>';

    for (let i= 0; i <stArray.length; i++) { 
      tableData += `<tr>
        <td>${stArray[i].getElementsByTagName("studentname")[0].innerHTML}</td>
        <td>${stArray[i].getElementsByTagName("center")[0].innerHTML}</td>
      </tr>`;
    }

     document.getElementById("display-center").innerHTML = tableData;
  }else{
    document.getElementById("display-center").innerHTML = '<tr><td colspan="2"><h1>No Record Found!</h1></td></tr>';
  }

  
}



//Get students by category
function loadStudentByCat(catId) {
  
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", $requestUrl);
  xmlhttp.setRequestHeader("X_Requested_With", "xmlhttprequest");

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

        getStudentByCat(this);
      }
  };
  xmlhttp.setRequestHeader('Content-Type', 'text/xml');

  let xmlData = `<?xml version='1.0'?>
  <query>
  <type>category</type>
  <page>1</page>
  <per_page>5</per_page>
  <seviceid>${catId}</seviceid>
  </query>`;

  xmlhttp.send(xmlData);
}


function getStudentByCat(xml) {
  const xmlDoc = xml.responseXML;
  const stArray = xmlDoc.getElementsByTagName("student");
  const status = xmlDoc.getElementsByTagName("status")[0].innerHTML;
  console.log(stArray);

  if(status == 'success'){

    var tableData ='<tr><th>Student</th><th>Subjects</th></tr>';

    for (let i= 0; i <stArray.length; i++) { 
      tableData += `<tr>
        <td>${stArray[i].getElementsByTagName("studentname")[0].innerHTML}</td>
        <td>${stArray[i].getElementsByTagName("subjects")[0].innerHTML}</td>
      </tr>`;
    }

     document.getElementById("showdata-category").innerHTML = tableData;
  }else{
    document.getElementById("showdata-category").innerHTML = '<tr><td colspan="2"><h1>No Record Found!</h1></td></tr>';
  }

  
}



//Get students by category
function loadStudentByCount(catId) {
  
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", $requestUrl);
  xmlhttp.setRequestHeader("X_Requested_With", "xmlhttprequest");

  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

        getStudentCount(this);
      }
  };
  xmlhttp.setRequestHeader('Content-Type', 'text/xml');

  let xmlData = `<?xml version='1.0'?>
  <query>
  <type>count</type>
  <seviceid>${catId}</seviceid>
  </query>`;

  xmlhttp.send(xmlData);
}

function getStudentCount(xml) {
  const xmlDoc = xml.responseXML;
  const stArray = xmlDoc.getElementsByTagName("categories");
  const status = xmlDoc.getElementsByTagName("status")[0].innerHTML;
  console.log(stArray);

  if(status == 'success'){

    var tableData ='<tr><th>Category</th><th>No. of Students</th></tr>';
    tableData += `<tr>
      <td>${stArray[0].getElementsByTagName("category")[0].innerHTML}</td>
      <td>${stArray[0].getElementsByTagName("students")[0].innerHTML}</td>
    </tr>`;
   
     document.getElementById("showstud-count").innerHTML = tableData;
  }else{
    document.getElementById("showstud-count").innerHTML = '<tr><td colspan="2"><h1>No Record Found!</h1></td></tr>';
  }

  
}