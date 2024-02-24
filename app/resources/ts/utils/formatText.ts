export const formatText = (text: string | null): string | undefined => {
    return text?.replace(/\n/g, '<br>');
}