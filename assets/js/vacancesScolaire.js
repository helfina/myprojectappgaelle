var myHeaders = new Headers();
myHeaders.append("accept", "application/json; charset=utf-8");

var requestOptions = {
    method: 'GET',
    headers: myHeaders,
    redirect: 'follow'
};

fetch("https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-calendrier-scolaire&q=start_date%3E%3D%222021-12-31T23%3A00%3A00Z%22&lang=fr&facet=description&facet=population&facet=start_date&facet=end_date&facet=location&facet=zones&facet=annee_scolaire&refine.location=Rennes&refine.start_date=2022", requestOptions)
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));