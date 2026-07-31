export default function ApplicationLogo(props) {
    return (
        <img
            {...props}
            src="/gambar/aset/logo-elcoding.svg"
            alt="Elcoding.id"
            className={`object-contain ${props.className || ''}`}
        />
    );
}
