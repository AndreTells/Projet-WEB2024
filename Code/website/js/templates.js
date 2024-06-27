const messageTemplate = (obj) =>(`
        <div class="message sm">${obj.content}</div>
`)
.data(obj);


const convTemplate = (obj) =>(`
            <div class="conv pt-2 pb-2 d-flex justify-content-around align-items-center selected">
<h6>${obj.title}</h6>
            </div>
`)
.data(obj);
