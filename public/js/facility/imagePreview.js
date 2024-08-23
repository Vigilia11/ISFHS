// DOM utility functions:

const el = (sel, par) => (par || document).querySelector(sel);
const elNew = (tag, props) => Object.assign(document.createElement(tag), props);


// Preview images before upload:

const elFiles = el("#files");
const elPreview = el("#preview");

const previewImage = (props) => elPreview.append(elNew("img", props));

const reader = (file, method = "readAsDataURL") => new Promise((resolve, reject) => {
const fr = new FileReader();
fr.onload = () => resolve({ file, result: fr.result });
fr.onerror = (err) => reject(err);
fr[method](file);
});

const previewImages = async(files) => {
// Remove existing preview images
elPreview.innerHTML = "";

let filesData = [];

try {
    // Read all files. Return Array of Promises
    const readerPromises = files.map((file) => reader(file));
    filesData = await Promise.all(readerPromises);
} catch (err) {
    // Notify the user that something went wrong.
    elPreview.textContent = "An error occurred while loading images. Try again.";
    // In this specific case Promise.all() might be preferred over
    // Promise.allSettled(), since it isn't trivial to modify a FileList
    // to a subset of files of what the user initially selected.
    // Therefore, let's just stash the entire operation.
    console.error(err);
    return; // Exit function here.
}

// All OK. Preview images:
filesData.forEach(data => {
    previewImage({
    src: data.result, // Base64 String
    alt: data.file.name // File.name String
    });
});
};

elFiles.addEventListener("change", (ev) => {
if (!ev.currentTarget.files) return; // Do nothing.
previewImages([...ev.currentTarget.files]);
});