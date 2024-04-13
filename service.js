function translateDiv() {
    const targetLanguage = document.getElementById("targetLanguage").value;
    const div = document.getElementById("contentToTranslate");
    const text = div.innerText.trim();

    translateText(text, targetLanguage)
        .then((translatedText) => {
            div.innerText = translatedText;
        })
        .catch((error) => {
            console.error('Translation error:', error);
        });
}

async function translateText(text, targetLanguage) {
    const response = await fetch('https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&to=' + targetLanguage, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Ocp-Apim-Subscription-Key': 'f35df9db5f4a4e62b7b25190550356b5'
        },
        body: JSON.stringify([{ text: text }])
    });

    const data = await response.json();
    console.log(data); // Log the response data
    return data[0].translations[0].text;
}
